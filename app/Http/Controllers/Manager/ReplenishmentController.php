<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Replenishment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class ReplenishmentController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        $products = Product::whereIn('category', ['Bebida', 'Postre'])->get();
        return view('manager.replenishment', compact('ingredients', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
        ]);

        $managerId = Auth::user()->user_id; 
        $quantity = $request->input('quantity');
        $cost = $request->input('cost');

        if ($request->has('ingredient_id')) {
            $replenishment = Replenishment::create([
                'manager_id' => $managerId,
                'replenishment_date' => now(),
                'ingredient_id' => $request->input('ingredient_id'),
                'quantity' => $quantity,
            ]);

            Ingredient::where('ingredient_id', $request->input('ingredient_id'))
                ->increment('stock', $quantity);
        } else if ($request->has('product_id')) {
            $replenishment = Replenishment::create([
                'manager_id' => $managerId,
                'replenishment_date' => now(),
                'product_id' => $request->input('product_id'),
                'quantity' => $quantity,
            ]);

            Product::where('product_id', $request->input('product_id'))
                ->increment('stock', $quantity);
        }

        Transaction::create([
            'replenishment_id' => $replenishment->replenishment_id,
            'transaction_money' => $quantity * $cost,
        ]);

        return redirect()->route('manager.replenishment')->with('success', 'Reposición realizada con éxito.');
    }
}
