<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener pedidos con sus productos
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product']) // Eager loading
            ->get();

        return view('order.index', compact('orders'));
    }
}
