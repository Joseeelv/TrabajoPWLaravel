@extends('layouts.app')

@section('title', 'Registro')
@section('body-class', 'body-login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush

@section('content')
    <h1>Regístrate</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="username" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
        @error('username') <p class="error">{{ $message }}</p> @enderror

        <div>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <div class="password-strength-meter">
                <div class="password-strength-meter-fill"></div>
            </div>
            <ul class="password-checklist">
                <li id="length">Al menos 8 caracteres</li>
                <li id="uppercase">Una letra mayúscula</li>
                <li id="lowercase">Una letra minúscula</li>
                <li id="number">Un número</li>
                <li id="special">Un carácter especial</li>
            </ul>
        </div>

        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <input type="text" name="address" placeholder="Dirección" value="{{ old('address') }}" required>
        @error('address') <p class="error">{{ $message }}</p> @enderror

        @if (session('success_message'))
            <p class="success">{{ session('success_message') }}</p>
        @endif

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/password-strength-meter.js') }}"></script>
@endpush
