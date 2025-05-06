<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function add(Request $request)
    {
        $id = $request->query('id');
        $cantidad = $request->query('cantidad', 1); // Default 1 if not passed

        $product = Producto::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cart = session()->get('cart', []);
        $cart[$id] = [
            'product' => $product,
            'cantidad' => $cantidad
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.view');
    }
}
