@extends('layouts.app')
<head>
    @section('header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döner Kebab Society</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <script src="{{ asset('assets/js/carrusel.js') }}" defer></script>
    @show
</head>
@section('content')
<main>
    <h1>Inicia Sesión</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>

        @if ($errors->any())
            <div class="error-container">
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </form>
    <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
</main>
@endsection
