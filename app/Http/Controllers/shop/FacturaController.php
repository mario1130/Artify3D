<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;

class FacturaController extends Controller
{
    public function descargar(Order $order)
    {
        $pdf = PDF::loadView('shop.factura_pdf', compact('order'));
        return $pdf->download('factura_'.$order->id.'.pdf');
    }
}
