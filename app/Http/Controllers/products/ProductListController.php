<?php
namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;

class ProductListController extends Controller
{
public function populars()
{
    $start = \Carbon\Carbon::now()->startOfMonth();
    $end = \Carbon\Carbon::now()->endOfMonth();

    $products = \App\Models\Product::query()
        ->select([
            'products.id',
            'products.name',
            'products.precio',
            'products.description',
            'products.category_id',
            'products.user_id',
            // add any other columns you need to display
        ])
        ->leftJoin('product_views', function($join) use ($start, $end) {
            $join->on('products.id', '=', 'product_views.product_id')
                ->whereBetween('product_views.created_at', [$start, $end]);
        })
        ->with('mainPhoto')
        ->selectRaw('COUNT(product_views.id) as views_count')
        ->groupBy([
            'products.id',
            'products.name',
            'products.precio',
            'products.description',
            'products.category_id',
            'products.user_id',
            // add any other columns you selected above
        ])
        ->orderByDesc('views_count')
        ->orderBy('products.name')
        ->paginate(12);

    return view('products.populars', compact('products'));
}

    public function bestRated()
    {
        $products = Product::with('mainPhoto')
            ->withAvg('ratings', 'stars')
            ->orderByDesc('ratings_avg_stars')
            ->orderBy('name')
            ->paginate(12);

        return view('products.best_rated', compact('products'));
    }
}