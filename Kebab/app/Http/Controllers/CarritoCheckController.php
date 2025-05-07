<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOffers;
use Illuminate\Support\Facades\Session;

class CarritoCheckController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userId = auth()->id(); // Asumiendo autenticación con Laravel

            $ofertasActivas = CustomerOffers::with(['offer.product'])
                ->where('user_id', $userId)
                ->get()
                ->map(function ($co) {
                    return [
                        'of_name' => $co->offer->offer_text,
                        'discount' => $co->offer->discount,
                        'nombre' => $co->offer->product->product_name,
                        'img' => $co->offer->product->img_src,
                        'coronas' => $co->offer->cost,
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
            return redirect()->route('error.500');
        }
    }
}

