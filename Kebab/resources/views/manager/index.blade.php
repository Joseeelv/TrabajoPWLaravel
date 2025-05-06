{{-- resources/views/manager/index.blade.php --}}

@extends('layouts.app') {{-- Usa el layout base generado por Breeze --}}

@section('content')
@php
    $image = Auth::user()->img_src ?? 'default.jpg';
    $path = public_path("assets/images/perfiles/{$image}");
    $image_url = file_exists($path) 
        ? asset("assets/images/perfiles/{$image}") 
        : asset("assets/images/perfiles/default.jpg");
@endphp

<main>
    <h1>Bienvenido, {{ Auth::user()->username }}.</h1>

    <img id="profile-image" src="{{ $image_url }}" alt="ImagenUser">

    <h2>¿Qué desea hacer?</h2>

    <div id="manager-options">
        <button class="btn btn-register" onclick="window.location.href='{{ url('/manager/replenishment') }}'">
            Reabastecer productos
        </button>
        <button class="btn btn-register" onclick="window.location.href='{{ url('/manager/transactions') }}'">
            Ver transacciones
        </button>
        <button class="btn btn-register" onclick="window.location.href='{{ url('/perfil') }}'">
            Ver perfil
        </button>
    </div>
</main>
@endsection