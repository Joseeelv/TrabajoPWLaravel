@extends('layouts.app')
<head>
  @section('header')
  <title>Cambiar Contraseña</title>
  <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  <script src="{{ asset('assets/js/password-strength-meter.js') }}"></script>
  @show
</head>
@section('content')
<h2>Restablecer contraseña</h2>
<form method="POST" action="{{ route('password.update') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <input type="hidden" name="email" value="{{ request('email', $email) }}">
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
  <div style="text-align: center;">
    <button type="submit">Actualizar Contraseña</button>
  </div>
</form>
@endsection

@push('scripts')
<script src="assets{assets/js/password-strength-meter.js}"></script>
@endpush