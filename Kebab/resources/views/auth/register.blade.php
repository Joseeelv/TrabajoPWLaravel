@extends('layouts.app')
<head>
    @section('header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döner Kebab Society</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    @show
</head>
<body>
@section('content')
    <script src="{{ asset('assets/js/password-strength-meter.js') }}" defer></script>
<main>
    <h1>Regístrate</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="username" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
        @error('username') <p class="error">{{ $message }}</p> @enderror

        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <input type="text" name="address" placeholder="Dirección" value="{{ old('address') }}" required>
        @error('address') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
</main>
@endsection
