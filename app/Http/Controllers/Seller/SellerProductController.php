<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;

class SellerProductController extends Controller
{
    public function index()
    {
        $business = Auth::user()->business;
        $products = $business->products()->with('inventory')->get();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:150',
            'slug'        => 'required|max:180|unique:PRODUCT,slug',
            'description' => 'nullable|max:255',
            'price'       => 'required|numeric|min:0',
            'visible'     => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock'       => 'required|integer|min:0'
        ]);

        $data = $request->all();
        $data['business_id'] = Auth::user()->business->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // <<< AQUÍ VA EL FIX >>>
        $product = Product::create($data);

        // Crear inventario
        Inventory::create([
            'product_id' => $product->id,
            'sku' => strtoupper('SKU-' . uniqid()),
            'stock' => $request->stock,
            'low_stock_threshold' => 1
        ]);

        return redirect()->route('seller.products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Product $product)
    {
        $this->authorizeProduct($product);

        return view('seller.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorizeProduct($product);

        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $request->validate([
            'name'        => 'required|max:150',
            'slug'        => 'required|max:180|unique:PRODUCT,slug,' . $product->id,
            'description' => 'nullable|max:255',
            'price'       => 'required|numeric|min:0',
            'visible'     => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock'       => 'required|integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Actualizar stock
        if (!$product->inventory) {
    $product->inventory()->create([
        'sku' => strtoupper('SKU-' . uniqid()),
        'stock' => $request->stock,
        'low_stock_threshold' => 1
    ]);
} else {
    $product->inventory->update([
        'stock' => $request->stock
    ]);
}

       

        return redirect()->route('seller.products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    private function authorizeProduct(Product $product)
    {
        $business = Auth::user()->business;
        if (!$business || $product->business_id !== $business->id) {
            abort(403, 'No puedes acceder a productos de otro negocio.');
        }
    }
}
