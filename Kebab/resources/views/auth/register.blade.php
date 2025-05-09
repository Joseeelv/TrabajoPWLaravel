@extends('layouts.app')

@section('title', __('messages.Registro'))
@section('body-class', 'body-login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush

@section('content')
    <h1>{{ __('messages.Regístrate') }}</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="user_type" value="customer">
        
        <input type="text" name="username" placeholder="{{ __('messages.Nombre de usuario') }}" value="{{ old('username') }}" required>
        @error('username') <p class="error">{{ $message }}</p> @enderror

        <div>
            <input type="password" name="password" id="password" placeholder="{{ __('messages.Contraseña') }}" required>
            <input type="password" name="password_confirmation" placeholder="{{ __('messages.Confirmar contraseña') }}" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <div class="password-strength-meter">
                <div class="password-strength-meter-fill"></div>
            </div>
            <ul class="password-checklist">
                <li id="length">{{ __('messages.Al menos 8 caracteres') }}</li>
                <li id="uppercase">{{ __('messages.Una letra mayúscula') }}</li>
                <li id="lowercase">{{ __('messages.Una letra minúscula') }}</li>
                <li id="number">{{ __('messages.Un número') }}</li>
                <li id="special">{{ __('messages.Un carácter especial') }}</li>
            </ul>
        </div>

        <input type="text" name="email" placeholder="{{ __('messages.Email') }}" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <input type="text" name="address" placeholder="{{ __('messages.Dirección') }}" value="{{ old('address') }}" required>
        @error('address') <p class="error">{{ $message }}</p> @enderror

        @if (session('success_message'))
            <p class="success">{{ session('success_message') }}</p>
        @endif

        <button type="submit">{{ __('messages.Registrarse') }}</button>
    </form>

    <p>{{ __('messages.¿Ya tienes una cuenta?') }} <a href="{{ route('login') }}">{{ __('messages.Iniciar sesión') }}</a></p>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/password-strength-meter.js') }}"></script>
@endpush
