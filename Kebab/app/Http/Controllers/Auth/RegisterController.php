<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $allowedDomains = [
            'gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com', 'example.com', 'test.com'
        ];

        $request->validate([
            'username' => [
                'required', 'min:3', 'max:20',
                'regex:/^[a-zA-Z0-9_]+$/',
                'unique:users,username'
            ],
            'password' => [
                'required', 'min:8',
                'regex:/[a-z]/',      // minúscula
                'regex:/[A-Z]/',      // mayúscula
                'regex:/\d/',         // número
                'regex:/[@$!%*?&_\-]/', // especial
                'confirmed'
            ],
            'email' => [
                'required', 'email',
                function ($attribute, $value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Por favor, utiliza un dominio de correo electrónico válido.');
                    }
                },
                'unique:users,email'
            ],
            'address' => 'required|string|max:255',
        ], [
            // Mensajes personalizados...
        ]);

        // Crear el usuario con user_type 'customer' por defecto
        $user = User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'user_type' => 'customer', // Asignación fija aquí
        ]);

        // Crear registro en tabla customers
        Customer::create([
            'user_id'          => $user->id,
            'customer_address' => $request->address,
            'customer_name'    => $request->username,
            'customer_email'   => $request->email,
        ]);

        return redirect()->route('login')->with('success_message', '¡Usuario registrado correctamente!');
    }

    public function create()
    {
        return view('auth.register');
    }
}
