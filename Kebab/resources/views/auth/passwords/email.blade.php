@extends('layouts.app')
<head>
    @section('header')
    <title>Email - Contraseña nueva</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
    @show
</head>
@section('content')
    <h2>¿Olvidaste tu contraseña?</h2>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required>
        <button type="submit">Enviar enlace de recuperación</button>
    </form>
@endsection
