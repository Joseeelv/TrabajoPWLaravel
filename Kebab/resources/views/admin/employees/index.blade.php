@extends('layouts.app')

<head>
  @section('header')
  <title>Admin Panel - Empleados</title>
  <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  @show
</head>
@section('content')
<h1>Empleados de Kebab Society</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

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
@endsection