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
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $mensaje = 'password.sent';
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __('messages.' . $mensaje)])
            : back()->withErrors(['email' => __('messages.' . $mensaje)]);
    }
}
