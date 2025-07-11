<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Notifications\ProductCommented;
use Illuminate\Support\Facades\Notification;
use App\Models\AdminNotification; 

class CommentController extends Controller
{

    public function comments()
    {
        $products = Product::where('user_id', auth()->id())
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->paginate(8);

        return view('profile.comentarios', compact('products'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Verificar que el usuario autenticado sea el propietario del comentario
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comentario eliminado correctamente.');
        }

        return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string|max:500',
        ]);

        // Obtener el producto
        $product = Product::findOrFail($request->product_id);

        // Crear el comentario
        $comment = Comment::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Verificar si existe una notificación no leída para el producto
        $unreadNotification = $product->user->notifications()
            ->where('type', ProductCommented::class)
            ->where('data->product_id', $product->id)
            ->whereNull('read_at')
            ->first();

        if ($unreadNotification) {
            // Actualizar el contenido de la notificación existente
            $data = $unreadNotification->data;
            $data['comment_count'] = ($data['comment_count'] ?? 0) + 1;
            $data['message'] = "Tu producto '{$product->name}' ha recibido {$data['comment_count']} nuevos comentarios.";
            $unreadNotification->update(['data' => $data]);
        } else {
            // Crear una nueva notificación
            $product->user->notify(new ProductCommented($product, $comment->content));
        }

        return redirect()->back()->with('success', 'Comentario añadido correctamente.');
    }
    public function report($id, Request $request)
    {
        \App\Models\CommentReport::create([
            'comment_id' => $id,
            'user_id' => auth()->id(),
            'reason' => $request->input('reason', 'Sin motivo'),
        ]);

        // Crear notificación para admin
        AdminNotification::create([
            'title' => 'Denuncia de comentario',
            'message' => 'Un usuario ha denunciado un comentario. Revisa la sección de denuncias.',
            'admin_id' => 1, // O null si es global
            'read_at' => null,
            'type' => 'comment_report', 
        ]);

        return back()->with('success', 'Comentario denunciado.');
    }
}
