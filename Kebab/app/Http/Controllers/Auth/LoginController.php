<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function show()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $maxAttempts = 5;
        $decayMinutes = 30;

        // 1. Verificar bloqueo por intentos fallidos
        if (RateLimiter::tooManyAttempts($this->throttleKey($username), $maxAttempts)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($username));
            throw ValidationException::withMessages([
                'username' => ["La cuenta está temporalmente bloqueada. Inténtelo de nuevo en $seconds segundos."],
            ]);
        }

        // 2. Intentar login
        if (Auth::attempt(['username' => $username, 'password' => $request->password])) {
            RateLimiter::clear($this->throttleKey($username));
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirección según tipo de usuario
            switch ($user->user_type) {
                case 'admin':
                    return redirect('/admin');
                case 'manager':
                    // Si es manager inactivo, cerrar sesión y mostrar error
                    if (isset($user->manager) && !$user->manager->employee) {
                        Auth::logout();
                        return back()->withErrors(['username' => 'Esta cuenta de manager está inactiva.']);
                    }
                    return redirect('/manager_index');
                case 'customer':
                    return redirect('/dashboard');
                default:
                    return redirect('/');
            }
        } else {
            // 3. Registrar intento fallido
            RateLimiter::hit($this->throttleKey($username), $decayMinutes * 60);
            throw ValidationException::withMessages([
                'password' => ['Contraseña inválida.'],
            ]);
        }
    }

    // Genera una clave única para rate limiting por usuario e IP
    protected function throttleKey($username)
    {
        return strtolower($username) . '|' . request()->ip();
    }

    // Logout seguro
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
