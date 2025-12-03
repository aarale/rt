<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('business', 'inventory')
            ->whereHas('inventory', fn($q) => $q->where('stock', '>', 0))
            ->where('visible', true);

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($category = $request->input('category')) {
            $query->whereHas('categories', fn($q) => $q->where('slug', $category));
        }

        $products = $query->get();
        $categories = Category::all();
        $oneWeekAgo = Carbon::now()->subWeek();
        $topProducts = Product::with('business')
            ->whereHas('orderItems', fn($q) => $q->where('created_at', '>=', $oneWeekAgo))
            ->withCount(['orderItems as sold_count' => fn($q) => $q->where('created_at', '>=', $oneWeekAgo)])
            ->orderByDesc('sold_count')
            ->take(8)
            ->get();

        return view('catalog.index', compact('products', 'categories', 'topProducts'));
    }




    public function category($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $products = Product::with('business', 'inventory')
        ->whereHas('inventory', fn($q) => $q->where('stock', '>', 0))
        ->where('visible', true)
        ->whereHas('categories', fn($q) => $q->where('slug', $slug))
        ->get();
 $oneWeekAgo = Carbon::now()->subWeek();
        $topProducts = Product::with('business')
            ->whereHas('orderItems', fn($q) => $q->where('created_at', '>=', $oneWeekAgo))
            ->withCount(['orderItems as sold_count' => fn($q) => $q->where('created_at', '>=', $oneWeekAgo)])
            ->orderByDesc('sold_count')
            ->take(8)
            ->get();

        return view('catalog.category', compact('products', 'category', 'topProducts'));
}

public function byCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

    $products = Product::whereHas('categories', function ($q) use ($category) {
        $q->where('categories.id', $category->id);

    })->with('inventory')->where('visible', 1)->get();

    return view('catalog.category', compact('products', 'category','categories'));
}
public function show($slug)
{
    $product = Product::with(['inventory', 'categories', 'business'])
        ->where('slug', $slug)
        ->where('visible', 1)
        ->firstOrFail();

    return view('catalog.show', compact('product'));
}

}
