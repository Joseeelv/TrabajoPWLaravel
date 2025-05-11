@extends('layouts.app')
<head>
    @section('header')
    <title>{{ __('messages.Admin Panel') }}</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
    @show
</head>

@section('content')
    @php
        $image = Auth::user()->img_src ?? 'default.jpg';
        $path = public_path("assets/images/perfiles/{$image}");
        $image_url = file_exists($path)
            ? asset("assets/images/perfiles/{$image}")
            : asset("assets/images/perfiles/default.jpg");
    @endphp

    <h1>{{ __('messages.Panel de Administración') }}</h1>
    <p>{{ __('messages.Bienvenido de nuevo, :user', ['user' => Auth::user()->username]) }}</p>
    <img id="profile-image" src="{{ $image_url }}" alt="ImagenUser">

    <h2>{{ __('messages.¿Qué desea hacer?') }}</h2>

    <div id="manager-options">
        <button class="btn btn-register" onclick="window.location.href='{{ url('/adminPanel/empleados') }}'">{{ __('messages.Ver empleados') }}</button>
        <button class="btn btn-register" onclick="window.location.href='{{ url('/adminPanel/contratar') }}'">{{ __('messages.Contratar nuevos empleados') }}</button>
        <button class="btn btn-register" onclick="window.location.href='{{ url('/manager/transactions') }}'">{{ __('messages.Ver transacciones') }}</button>
        <button class="btn btn-register" onclick="window.location.href='{{ url('/perfil') }}'">{{ __('messages.Ver perfil') }}</button>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
@endpush
