<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Manager;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro de un nuevo usuario (manager o customer)
     */
    public function register(Request $request)
    {
        $allowedDomains = [
            'gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com', 'example.com', 'test.com'
        ];

        // Determina el tipo de usuario
        $isManager = $request->input('user_type') === 'manager';

        // Reglas de validación dinámicas
        $rules = [
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
            'user_type' => 'required|in:customer,manager',
        ];

        // Solo para customers, email y dirección son obligatorios
        if (!$isManager) {
            $rules['email'] = [
                'required', 'email',
                function ($value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Por favor, utiliza un dominio de correo electrónico válido.');
                    }
                },
                'unique:users,email'
            ];
            $rules['address'] = 'required|string|max:255';
        }

        // Validar datos
        $request->validate($rules);

        // Crear el usuario
        $user = User::create([
            'username'  => $request->username,
            'email'     => $isManager
                            ? $request->username . '@donerkebab.com'
                            : $request->email,
            'password'  => bcrypt($request->password),
            'user_type' => $request->user_type,
        ]);

        // Si es customer, crea registro en customers
        if ($user->user_type === 'customer') {
            Customer::create([
                'user_id'          => $user->user_id,
                'customer_address' => $request->address,
                'customer_name'    => $request->username,
                'customer_email'   => $request->email,
            ]);
        }

        // Si es manager, crea registro en managers
        if ($user->user_type === 'manager') {
            Manager::create([
                'user_id' => $user->user_id,
                'salary' => 2500, // por defecto    
                'employee' => 1, // por defecto contratado
            ]);
        }
        
        if ($request->is('adminPanel/contratar')) {
            return back()->with('success_message', '¡Usuario registrado correctamente!');
        }
        else{
            return redirect()->route('login')->with('success_message', '¡Usuario registrado correctamente!');
        }
    }
}
