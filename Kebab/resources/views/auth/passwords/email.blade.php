@extends('layouts.app')
<head>
    @section('header')
    <title>{{ __('messages.Email - Nueva Contraseña') }}</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    @show
</head>

@section('content')
    <h2>{{ __('messages.¿Olvidaste tu contraseña?') }}</h2>

    @if (session('status'))
        <div><h3>{{ session('status') }}</h3></div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">{{ __('messages.Correo electrónico:') }}</label>
        <input type="email" name="email" required>
        <button type="submit">{{ __('messages.Enviar enlace de recuperación') }}</button>
    </form>
@endsection
