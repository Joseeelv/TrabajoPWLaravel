@extends('layouts.app')

@section('title', 'Iniciar sesión')
@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush

@section('content')
<main>
  <h1>Inicia Sesión</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="text" name="username" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit" name="login">Iniciar sesión</button>

    @if ($errors->any())
      <div class="error-container">
        @foreach ($errors->all() as $error)
          <p class="error">{{ $error }}</p>
        @endforeach
      </div>
    @endif

    @if (session('success_message'))
      <p class="success">{{ session('success_message') }}</p>
    @endif
  </form>
  <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
</main>
@endsection
