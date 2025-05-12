<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Customer;
use Carbon\Carbon;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::with('customer')->orderBy('review_date', 'desc')->get();
        return view('review', compact('reviews'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // Verificar que sea un customer válido (que tenga entrada en CUSTOMERS)
        $customer = Customer::where('user_id', $user->user_id)->first();

        if (!$customer) {
            return redirect()->route('reviews')->withErrors(['error' => 'Solo los clientes pueden dejar reseñas.']);
        }

        Review::create([
            'user_id' => $customer->user_id, // Asegura que existe en CUSTOMERS
            'rating' => $request->input('rating'),
            'review_text' => $request->input('review_text'),
            'review_date' => now()->toDateString(),
        ]);

        return redirect()->route('reviews')->with('mensaje', '¡Reseña enviada correctamente!');
    }


    public function managerIndex()
    {
    $reviews = Review::with(['customer.user'])->orderByDesc('review_date')->get();
    $token = csrf_token(); // o cualquier otro valor necesario
    return view('manager.reviews.index', compact('reviews', 'token'));
    }

    public function respondForm($id)
    {
        $review = Review::with(['customer.user'])->findOrFail($id);
        return view('manager.reviews.respond', compact('review'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'answer_text' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);
        $review->answer_text = $request->answer_text;

        //Esto debe ser un número, no una cadena
        $review->manager_id = Auth::user()->id;

        $review->save();

        return redirect()->route('manager.reviews.index')->with('mensaje', 'Respuesta enviada correctamente.');
    }

}
