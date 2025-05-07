<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfertaController extends Controller
{
    public function index(Request $request)
    {
        $offers = Offers::with('product')->get();
        $user = Auth::user();

        return view('ofertas', compact('offers', 'user'));
    }

    public function activate(Request $request)
    {
        $offerId = $request->input('Oferta');
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->user_id)->first();


        $offer = Offers::findOrFail($offerId);
        $alreadyActivated = DB::table('CUSTOMERS_OFFERS')
                              ->where('user_id', $user->user_id)
                              ->where('offer_id', $offerId)
                              ->exists();

        if ($alreadyActivated) {
            return redirect()->back()->with('message', 'La oferta ya está activada.');
        }

        if ($customer->points >= $offer->cost) {
            DB::table('CUSTOMERS_OFFERS')->insert([
                'user_id' => $user->user_id,
                'offer_id' => $offer->offer_id,
                'activation_date' => now()
            ]);

            $customer->points -= $offer->cost;
            $user->save();
            $customer->save();

            return redirect()->back()->with('message', 'Oferta activada correctamente.');
        } else {
            return redirect()->back()->with('message', 'No tienes suficientes puntos para activar esta oferta.');
        }
    }
}
