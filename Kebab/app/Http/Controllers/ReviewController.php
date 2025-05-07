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

        // Verifica si el usuario actual está en CUSTOMERS
        $userId = auth()->id();
        $isCustomer = Customer::where('user_id', $userId)->exists();

        if (!$isCustomer) {
            return redirect()->route('reviews')->withErrors(['Solo los clientes pueden dejar reseñas.']);
        }

        Review::create([
            'user_id' => $userId,
            'rating' => $request->input('rating'),
            'review_text' => $request->input('review_text'),
            'review_date' => now()->toDateString(),
        ]);

        return redirect()->route('review')->with('mensaje', '¡Reseña enviada correctamente!');
    }
}
