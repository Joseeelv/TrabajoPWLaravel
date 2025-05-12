<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'exists:users,email', // Verifica que el correo exista en la tabla users
                function ($attribute, $value, $fail) {
                    if (str_ends_with($value, '@donerkebab.com')) {
                        $fail(__('Emails from the donerkebab.com domain cannot be used for password reset.'));
                    }
                },
            ],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $mensaje = 'password.sent';
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __('messages.' . $mensaje)])
            : back()->withErrors(['email' => __('messages.' . $mensaje)]);
    }
}
