<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::with('business')->where('visible', true)->get();
$products = Product::with('business', 'inventory')
    ->whereHas('inventory', function($q) {
        $q->where('stock', '>', 0);
    })
    ->where('visible', true)
    ->get();

        return view('catalog.index', compact('products'));
    }
    
}
