@extends('layouts.app')

<head>
  @section('header')
  <title>Admin Panel - Contratación</title>
  <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  @show
</head>
@section('content')
<main>
  <h1>Zona de contrato</h1>

  @if(session('success'))
  <div class="success">{{ session('success') }}</div>
  @endif

  {{-- Registro de manager --}}

 <form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" name="user_type" value="manager">
    <div>
      <input type="text" name="username" placeholder="Nombre de usuario" required>
      <input type="password" name="password" id="password" placeholder="Contraseña" required>
      <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
    </div>
    <div class="password-strength-meter">
      <div class="password-strength-meter-fill"></div>
    </div>
    <ul class="password-checklist">
      <li id="length">Al menos 8 caracteres</li>
      <li id="uppercase">Contiene mayúscula</li>
      <li id="lowercase">Contiene minúscula</li>
      <li id="number">Contiene número</li>
      <li id="special">Contiene carácter especial</li>
    </ul>
    <button type="submit" name="register">Registrar manager</button>
    @if($errors->any())
    <div class="error-container">
      @foreach($errors->all() as $error)
      <p class="error">{{ $error }}</p>
      @endforeach
    </div>
    @endif
</form>


  {{-- Managers activos --}}
  <h2>Managers Activos</h2>
  <form method="POST" action="{{ route('admin.employees.fire') }}">
    @csrf
    <table>
      <tr>
        <th>Seleccionar</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Salario</th>
      </tr>
      @forelse($activeManagers as $manager)
      <tr>
        <td><input type="checkbox" name="despedir[]" value="{{ $manager->user_id }}"></td>
        <td>{{ $manager->user->username }}</td>
        <td>{{ $manager->user->email }}</td>
        <td>{{ $manager->salary}}€</td>
      </tr>
      @empty
      <tr>
        <td colspan="4">No se encontraron empleados activos.</td>
      </tr>
      @endforelse
    </table>
    <button type="submit">Despedir seleccionados</button>
  </form>

  {{-- Managers despedidos --}}
  <h2>Managers Despedidos</h2>
  <form method="POST" action="{{ route('admin.employees.hire') }}">
  @csrf
  <table>
    <tr>
      <th>Seleccionar</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Salario</th>
    </tr>
    @forelse($inactiveManagers as $manager)
    <tr>
      <td><input type="checkbox" name="contratar[]" value="{{ $manager->user_id }}"></td>
      <td>{{ $manager->user->username }}</td>
      <td>{{ $manager->user->email }}</td>
      <td>{{ $manager->salary}}€</td>
      </tr>
    @empty
    <tr>
      <td colspan="4">No hay managers despedidos.</td>
    </tr>
    @endforelse
  </table>
  <button type="submit">Recontratar seleccionados</button>
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