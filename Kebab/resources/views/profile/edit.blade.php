@extends('layouts.app')
<head>
    @section('header')
    <title>Modificar Perfil</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/manager.css') }}">
    @show
</head>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/previewFoto.js') }}" defer></script>
    <script src="{{ asset('assets/js/password-strength-meter.js') }}"></script>
@endpush

@section('content')
    @php
        $image = Auth::user()->img_src ?? 'default.jpg';
        $path = public_path("assets/images/perfiles/{$image}");
        $image_url = file_exists($path)
            ? asset("assets/images/perfiles/{$image}")
            : asset("assets/images/perfiles/default.jpg");
    @endphp
<main>
    <h1>Modificar Perfil</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="error-container">
            @foreach($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form id="updateProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(Auth::user()->user_type === 'customer')
        <div class="form-group">
            <label for="email">Nuevo Email:</label>
            <input type="email" id="email" name="email" placeholder="{{ old('email', Auth::user()->email) }}">
        </div>
        @endif

        <div>
            <input type="password" name="password" id="password" placeholder="Contraseña">
            <!-- Barra de fortaleza -->
            <div class="password-strength-meter">
                <div class="password-strength-meter-fill"></div>
            </div>
            <ul class="password-checklist">
                <li id="length">Al menos 8 caracteres de longitud</li>
                <li id="uppercase">Contiene letra mayúscula</li>
                <li id="lowercase">Contiene letra minúscula</li>
                <li id="number">Contiene número</li>
                <li id="special">Contiene carácter especial</li>
            </ul>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirmar contraseña">
        </div>

        @if(Auth::user()->user_type === 'customer')
        <div class="form-group">
            <label for="address">Nueva dirección:</label>
            <input type="text" id="address" name="address" placeholder="{{ old('address', Auth::user()->customer->customer_address ?? '') }}">
        </div>
        @endif

        <div class="form-group">
            <label for="foto">Nueva foto de perfil:</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            <div style="text-align: center;">
                <img id="previewImage" src="{{ $image_url }} "alt="Vista previa"
                 style="{{ Auth::user()->img_src ? 'width: 200px; height: auto;' : 'display: none;' }}">
            </div>
        </div>

        <button type="submit">Actualizar Perfil</button>
    </form>
</main>
@endsection
