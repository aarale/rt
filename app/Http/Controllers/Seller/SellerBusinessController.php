<?php

namespace App\Http\Controllers\Seller;


use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SellerBusinessController extends Controller
{   
    public function create()
    {
        $user = auth()->user();

        if ($user->business) {
            return redirect()->route('seller.dashboard')->with('info', 'Ya tienes un negocio registrado.');
        }

        return view('seller.business.create');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120',
            'slug' => 'required|max:100|unique:BUSINESS,slug',
            'description' => 'nullable'
        ]);

        $user = auth()->user();

        Business::create([
            'seller_id' => $user->id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Negocio creado exitosamente.');
    }

    public function edit()
    {
        $business = auth()->user()->business;

        return view('seller.business.edit', compact('business'));
    }

    public function update(Request $request)
    {
        $business = auth()->user()->business;

        $request->validate([
            'name' => 'required|max:120',
            'slug' => 'required|max:100|unique:BUSINESS,slug,' . $business->id,
            'description' => 'nullable',
        ]);

        $business->update($request->all());

        return redirect()->route('seller.dashboard')->with('success', 'Negocio actualizado.');
    }
}
