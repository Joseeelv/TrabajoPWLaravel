@extends('layouts.app')

<head>
  @section('header')
  <title>{{ __('messages.Admin Panel - Contratación') }}</title>
  <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  @show
</head>

@section('content')
<main>
  <h1>{{ __('messages.Zona de contrato') }}</h1>

  @if(session('success'))
  <div class="success">{{ session('success') }}</div>
  @endif

  {{-- Registro de manager --}}
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" name="user_type" value="manager">
    <div>
      <input type="text" name="username" placeholder="{{ __('messages.Nombre de usuario') }}" required>
      <input type="password" name="password" id="password" placeholder="{{ __('messages.Contraseña') }}" required>
      <input type="password" name="password_confirmation" placeholder="{{ __('messages.Confirmar contraseña') }}" required>
    </div>
    <div class="password-strength-meter">
      <div class="password-strength-meter-fill"></div>
    </div>
    <ul class="password-checklist">
      <li id="length">{{ __('messages.Al menos 8 caracteres') }}</li>
      <li id="uppercase">{{ __('messages.Contiene mayúscula') }}</li>
      <li id="lowercase">{{ __('messages.Contiene minúscula') }}</li>
      <li id="number">{{ __('messages.Contiene número') }}</li>
      <li id="special">{{ __('messages.Contiene carácter especial') }}</li>
    </ul>
    <button type="submit" name="register">{{ __('messages.Registrar manager') }}</button>

    @if($errors->any())
    <div class="error-container">
      @foreach($errors->all() as $error)
      <p class="error">{{ $error }}</p>
      @endforeach
    </div>
    @endif
  </form>

  {{-- Managers activos --}}
  <h2>{{ __('messages.Managers Activos') }}</h2>
  <form method="POST" action="{{ route('admin.employees.fire') }}">
    @csrf
    <table>
      <tr>
        <th>{{ __('messages.Seleccionar') }}</th>
        <th>{{ __('messages.Nombre') }}</th>
        <th>{{ __('messages.Email') }}</th>
        <th>{{ __('messages.Salario') }}</th>
      </tr>
      @forelse($activeManagers as $manager)
      <tr>
        <td><input type="checkbox" name="despedir[]" value="{{ $manager->user_id }}"></td>
        <td>{{ $manager->user->username }}</td>
        <td>{{ $manager->user->email }}</td>
        <td>{{ $manager->salary }}€</td>
      </tr>
      @empty
      <tr>
        <td colspan="4">{{ __('messages.No se encontraron empleados activos.') }}</td>
      </tr>
      @endforelse
    </table>
    <button type="submit">{{ __('messages.Despedir seleccionados') }}</button>
  </form>

  {{-- Managers despedidos --}}
  <h2>{{ __('messages.Managers Despedidos') }}</h2>
  <form action="{{ route('admin.employees.hire') }}" method="POST">
    @csrf
    <table>
      <tr>
        <th>{{ __('messages.Seleccionar') }}</th>
        <th>{{ __('messages.Nombre') }}</th>
        <th>{{ __('messages.Email') }}</th>
        <th>{{ __('messages.Salario') }}</th>
      </tr>
      @forelse($inactiveManagers as $manager)
      <tr>
        <td><input type="checkbox" name="contratar[]" value="{{ $manager->user_id }}"></td>
        <td>{{ $manager->user->username }}</td>
        <td>{{ $manager->user->email }}</td>
        <td>{{ $manager->salary }}€</td>
      </tr>
      @empty
      <tr>
        <td colspan="4">{{ __('messages.No hay managers despedidos.') }}</td>
      </tr>
      @endforelse
    </table>
    <button type="submit">{{ __('messages.Recontratar seleccionados') }}</button>
  </form>
</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/password-strength-meter.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush