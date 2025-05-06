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
        $maxAttempts = 1000;
        $decayMinutes = 30;

        // Verificar bloqueo por intentos fallidos
        if (RateLimiter::tooManyAttempts($this->throttleKey($username), $maxAttempts)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($username));
            throw ValidationException::withMessages([
                'username' => ["La cuenta está temporalmente bloqueada. Inténtelo de nuevo en $seconds segundos."],
            ]);
        }
        if (Auth::attempt(['username' => $username, 'password' => $request->password])) {
            RateLimiter::clear($this->throttleKey($username));
            $request->session()->regenerate();
        
            // No vuelvas a usar Auth::user() inmediatamente, ya tienes el user
            $user = \App\Models\User::where('username', $username)->first();
        
            return match ($user->user_type) {
                'admin' => redirect('/admin'),
                'manager' => redirect('/manager_index'),
                'customer' => redirect('/dashboard'),
                default => redirect('/'),
            };
        }
        

        // Registrar intento fallido
        RateLimiter::hit($this->throttleKey($username), $decayMinutes * 60);
        throw ValidationException::withMessages([
            'password' => ['Contraseña inválida.'],
        ]);
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
