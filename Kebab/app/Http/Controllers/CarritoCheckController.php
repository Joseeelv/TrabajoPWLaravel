<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOffers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CarritoCheckController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userId = Auth::user()->user_id; // Asumiendo autenticación con Laravel

            $ofertasActivas = CustomerOffers::with(['offers.product'])
                ->where('user_id', $userId)
                ->get()
                ->map(function ($co) {
                    return [
                        'offer_id' => $co->offers->offer_id,
                        'of_name' => $co->offers->offer_text,
                        'discount' => $co->offers->discount,
                        'nombre' => $co->offers->product->product_name,
                        'img' => $co->offers->product->img_src,
                        'coronas' => $co->offers->cost,
                        'used' => $co->used,
                    ];
                });

            Session::put('ofertasActivas', $ofertasActivas);

            $compra = Session::get('compra', []);

            // Ordenar por nombre
            usort($compra, fn($a, $b) => strcmp($a['nombre'], $b['nombre']));

            $v_total = 0;
            foreach ($compra as &$producto) {
                $precio_base = $producto['precio'] * $producto['cantidad'];
                $precio_final = $precio_base;

                foreach ($ofertasActivas as $oferta) {
                    if ($oferta['nombre'] == $producto['nombre']) {
                        $precio_final *= (1 - $oferta['discount'] / 100);
                        break;
                    }
                }

                $producto['precio_final'] = $precio_final;
                $v_total += $precio_final;
            }

            return view('carrito.index', compact('ofertasActivas', 'compra', 'v_total'));

        } catch (\Exception $e) {
            \Log::error("Error en la compra: " . $e->getMessage());
            return redirect()->route('error.500');
        }
    }
}

