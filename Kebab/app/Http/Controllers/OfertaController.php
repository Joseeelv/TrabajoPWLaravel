<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfertaController extends Controller
{
    public function index()
    {
        $ofertas = DB::table('offers')
            ->join('products', 'offers.prod_id', '=', 'products.product_id')
            ->select(
                'offers.offer_text as of_name',
                'offers.offer_id as id',
                'offers.cost as coronas',
                'offers.discount as discount',
                'products.product_name as nombre',
                'products.img_src as img'
            )
            ->get();

        $activas = [];

        if (Auth::check()) {
            $userId = Auth::id();
            $activas = DB::table('customers_offers')
                ->where('user_id', $userId)
                ->pluck('offer_id')
                ->toArray();
        }

        return view('Ofertas', compact('ofertas', 'activas'));
    }

    public function activar(Request $request)
    {
        $user = Auth::user();
        $ofertaId = $request->input('Oferta');
        $mensaje = "";

        $oferta = DB::table('offers')->where('offer_id', $ofertaId)->first();

        $yaAceptada = DB::table('customers_offers')
            ->where('user_id', $user->id)
            ->where('offer_id', $ofertaId)
            ->exists();

        if ($yaAceptada) {
            return back()->with('mensaje', 'La oferta ya está activa.');
        }

        if ($user->points >= $oferta->cost) {
            DB::table('customers_offers')->insert([
                'user_id' => $user->id,
                'offer_id' => $ofertaId,
                'activation_date' => now()
            ]);

            // Actualizar puntos
            DB::table('customers')->where('user_id', $user->id)
                ->update(['points' => $user->points - $oferta->cost]);

            $user->points -= $oferta->cost; // Para reflejarlo en la sesión si usas Auth
            $mensaje = 'Oferta activada correctamente.';
        } else {
            $mensaje = 'No tienes suficientes puntos.';
        }

        return back()->with('mensaje', $mensaje);
    }
}
