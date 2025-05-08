@extends('layouts.app')
<head>
    @section('header')
    <title>Cambiar Contraseña</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
    @show
</head>
@section('content')
    <h2>Restablecer contraseña</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ request('email', $email) }}">
        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password" required>
        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Restablecer</button>
    </form>
@endsection
