<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Mostrar el formulario de edición de perfil
    public function edit()
    {
        $user = Auth::user();

        if (!$user instanceof \App\Models\User) {
            abort(500, 'Authenticated user is not a valid User model instance.');
        }

        return view('profile.edit', compact('user'));
    }

    // Actualizar perfil
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'password' => 'nullable|confirmed|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB
        ];

        // Si es cliente, permitir editar email y dirección
        if ($user->user_type === 'customer') {
            $rules['email'] = [
                'nullable', // hace que el campo sea opcional
                'email',
                Rule::unique('users')->ignore($user->id),
                function($value, $fail) {
                    if ($value) { // Only validate if email is provided
                        $allowedDomains = ['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com'];
                        $domain = substr(strrchr($value, "@"), 1);
                        if (!in_array($domain, $allowedDomains)) {
                            $fail('El email debe ser de un dominio permitido.');
                        }
                    }
                },
            ];
            $rules['address'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);

        // Actualiza email si es cliente
        if ($user->user_type === 'customer' && isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        // Actualiza contraseña si se proporciona
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Actualiza dirección si es cliente
        if ($user->user_type === 'customer' && isset($validated['address'])) {
            $user->customer?->update(['customer_address' => $validated['address']]);
        }

        // Procesa la imagen de perfil
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $new_filename = $user->username . '.' . $extension;
            $destinationPath = public_path('assets/images/perfiles');
            $file->move($destinationPath, $new_filename);
    
        // Borra la imagen anterior si no es default.jpg y es diferente al nuevo nombre
        if ($user->img_src && $user->img_src !== 'default.jpg' && $user->img_src !== $new_filename) {
            $oldFilePath = public_path('assets/images/perfiles/' . $user->img_src);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    
        $user->img_src = $new_filename;

        if ($user instanceof \App\Models\User) {
            $user->save();
        } else {
            abort(500, 'Unable to save user. Invalid User model instance.');
        }
        }
        if($user->user_type === 'customer') {
            return redirect()->route('dashboard')->with('success', 'Perfil actualizado correctamente.');
        }
        else if($user->user_type === 'manager') {
            return redirect()->route('manager.index')->with('success', 'Perfil actualizado correctamente.');
        }
        else {
            return redirect()->route('admin.dashboard')->with('success', 'Perfil actualizado correctamente.');
        }
    }   
}
