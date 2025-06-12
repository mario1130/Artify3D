<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CommentReport;
use App\Models\Comment;
use App\Models\AdminLog; // Añadido

class CommentReportController extends Controller
{
    public function index()
    {
        $reports = CommentReport::with(['comment.user', 'comment.product'])
            ->latest()
            ->paginate(15);

        return view('dashboard.comments.admin_reports', compact('reports'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Eliminar comentario reportado',
            'description' => 'Comentario ID: ' . $id,
        ]);

        return redirect()->route('admin.comment_reports.index')->with('success', 'Comentario eliminado correctamente.');
    }
}