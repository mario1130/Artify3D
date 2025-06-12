<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductSold extends Notification
{
    use Queueable;

    protected $product;
    protected $order;
    protected $buyer;

    public function __construct($product, $order, $buyer)
    {
        $this->product = $product;
        $this->order = $order;
        $this->buyer = $buyer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'order_id' => $this->order->id,
            'buyer_name' => $this->buyer->name,
            'message' => "¡Tu producto '{$this->product->name}' ha sido vendido a {$this->buyer->name}!",
            'type' => 'Venta',
            // Lleva al producto vendido:
            'url' => config('app.url') . '/products/' . $this->product->id,
            // Si prefieres que lleve al pedido, usa:
            // 'url' => config('app.url') . '/pedidos/' . $this->order->id,
        ];
    }
}