@extends('layouts.app')

<head>
  @section('header')
  <title>{{ __('messages.Admin Panel - Empleados') }}</title>
  <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  @show
</head>

@section('content')
<h1>{{ __('messages.Empleados de Kebab Society') }}</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

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

<h2>{{ __('messages.Managers Despedidos') }}</h2>
<form method="POST" action="{{ route('admin.employees.hire') }}">
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
@endsection
