<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
{
    $stats = [
        'users' => User::count(),
        'businesses' => Business::count(),
        'products' => Product::count(),
        'sales' => Order::sum('total')
    ];

    return view('admin.dashboard', [
        'stats' => $stats,
        'users' => User::with('roles')->get(),
        'businesses' => Business::all(),
        'products' => Product::with('business')->get(),
        'sales' => Order::latest()->take(10)->get()
    ]);
}

}
