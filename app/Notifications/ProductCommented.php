<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductCommented extends Notification
{
    use Queueable;

    protected $product;
    protected $comment;

    public function __construct($product, $comment)
    {
        $this->product = $product;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'message' => "Tu producto '{$this->product->name}' ha recibido 1 nuevo comentario.",
            'comment_count' => 1, // Inicialmente 1 comentario
            'url' => config('app.url') . '/products/' . $this->product->id,
        ];
    }
}