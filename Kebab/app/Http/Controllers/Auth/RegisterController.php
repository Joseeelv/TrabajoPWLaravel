<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $allowedDomains = [
            'gmail.com',
            'hotmail.com',
            'outlook.com',
            'yahoo.com',
            'example.com',
            'test.com'
        ];

        $request->validate([
            'username' => [
                'required',
                'min:3',
                'max:20',
                'regex:/^[a-zA-Z0-9_]+$/',
                'unique:users,username'
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',      // minúscula
                'regex:/[A-Z]/',      // mayúscula
                'regex:/\d/',         // número
                'regex:/[@$!%*?&_\-]/', // especial
                'confirmed'
            ],
            'email' => [
                'required',
                'email',
                function ($value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Por favor, utiliza un dominio de correo electrónico válido.');
                    }
                },
                'unique:users,email'
            ],
            'address' => 'required|string|max:255'
        ], [
            // Mensajes personalizados
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
            'username.max' => 'El nombre de usuario no puede tener más de 20 caracteres.',
            'username.regex' => 'El nombre de usuario solo puede contener letras, números y guiones bajos.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener mayúsculas, minúsculas, números y caracteres especiales.',
            // Si pasa la validación, continúa con el registro...
            'email.email' => 'Por favor, introduce una dirección de email válida.',
            'email.unique' => 'Este email ya está registrado.',
            'address.required' => 'La dirección es obligatoria.'
        ]);

    }
    public function create()
    {
        return view('auth.register');
    }
}
