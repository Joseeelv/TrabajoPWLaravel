<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer; // Ensure the Customer model exists in the specified namespace

class Dashboard extends Controller
{
    public function dashboard()
    {
        // Suponiendo que el usuario está autenticado y su ID está en Auth
        $user_id = Auth::id();

        // Obtener los puntos del usuario (asumiendo tabla customers)
        $customer = Customer::where('user_id', $user_id)->first();

        // Guardar los puntos en la sesión de Laravel
        session(['points' => $customer->points ?? 0]);

        // Pasar los puntos a la vista
        return view('dashboard', [
            'points' => $customer->points ?? 0
        ]);
    }
}
