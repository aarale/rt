<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si no tiene negocio, lo enviamos a crearlo
        if (!$user->business) {
            return redirect()->route('seller.business.create');
        }

        $business = $user->business;

        // Productos del negocio
        $products = $business->products;

        // Estadísticas importantes
        $stats = [
            'products' => $business->products()->count(),
            'orders'   => Order::where('business_id', $business->id)->count(),
            'pending'  => Order::where('business_id', $business->id)
                                ->where('status', 'pending')
                                ->count(),
        ];

        return view('seller.dashboard', compact('business', 'products', 'stats'));
    }
}

