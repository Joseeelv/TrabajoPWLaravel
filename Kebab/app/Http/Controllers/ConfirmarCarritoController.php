<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemIngredient;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\CustomerOffer;

class CartController extends Controller
{
    public function confirmar(Request $request)
    {
        $userId = auth()->id();
        $compra = Session::get('compra', []);
        $ofertasActivas = Session::get('ofertasActivas', []);

        if (empty($compra)) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            $v_total = 0;

            foreach ($compra as $p) {
                $precio = $p['precio'] * $p['cantidad'];

                foreach ($ofertasActivas as $f) {
                    if ($f['nombre'] === $p['nombre']) {
                        $precio *= (1 - $f['discount'] / 100);
                    }
                }

                $v_total += $precio;
            }

            $puntos = intval($v_total * 10);
            Customer::where('user_id', $userId)->increment('points', $puntos);
            Session::put('puntos', Session::get('puntos', 0) + $puntos);

            $order = Order::create([
                'user_id' => $userId,
                'order_date' => Carbon::now()->format('Y-m-d'),
                'order_status' => 'pendiente',
            ]);

            foreach ($compra as $p) {
                $precio = $p['precio'] * $p['cantidad'];

                foreach ($ofertasActivas as $f) {
                    if ($f['nombre'] === $p['nombre']) {
                        $precio *= (1 - $f['discount'] / 100);
                    }
                }

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $p['id'],
                    'quantity' => $p['cantidad'],
                    'price' => $precio
                ]);

                if (in_array($p['category'], ['DRINK', 'DESSERT'])) {
                    Product::where('product_id', $p['id'])->decrement('stock', 1);
                } else {
                    foreach ($p['lista_ingredientes'] as $ing) {
                        $ingId = (int) $ing['id'];
                        $cantidad = (int) $ing['cantidad'];

                        if ($cantidad < 0) {
                            throw new \Exception("Cantidad inválida de ingrediente: ID $ingId.");
                        }

                        if (!Ingredient::where('ingredient_id', $ingId)->exists()) {
                            throw new \Exception("Ingrediente con ID $ingId no existe.");
                        }

                        OrderItemIngredient::create([
                            'order_item_id' => $orderItem->id,
                            'ingredient_id' => $ingId,
                            'quantity' => $cantidad,
                        ]);

                        Ingredient::where('ingredient_id', $ingId)->decrement('stock', $cantidad);
                    }
                }

                Transaction::create([
                    'order_id' => $order->id,
                    'replenishment_id' => null,
                    'transaction_money' => $precio,
                ]);
            }

            // Marcar ofertas como usadas
            foreach ($ofertasActivas as $f) {
                CustomerOffer::where('user_id', $userId)
                    ->where('offer_id', $f['offer_id'])
                    ->update(['used' => 1]);
            }

            Session::put('compra', []);
            DB::commit();

            return redirect()->route('pedido.confirmado');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error en la compra: " . $e->getMessage());
            return response()->view('errors.500', ['message' => 'Error al confirmar el pedido.'], 500);
        }
    }
}

