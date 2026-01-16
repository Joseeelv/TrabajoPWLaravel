@extends('layouts.app')

@section('title', __('menu.products')) <!-- Usar la traducción para el título -->

<head>
    @section('header')
    <title>{{ __('menu.products') }}</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
    @show
</head>

<body>
    @section('content')
        <main>
            <aside class="sidebar">
                <ul>
                    <form method="GET" action="{{ route('menu') }}">
                        @csrf
                        <input type="hidden" name="category" value="Ninguna">
                        <button type="submit">{{ __('messages.Ninguna') }}</button> <!-- Traducir 'Ninguna' -->
                    </form>
                    @foreach($categorias as $c)
                        <form method="GET" action="{{ route('menu') }}">
                            <input type="hidden" name="category" value="{{ $c['cat'] }}">
                            <button type="submit">{{ __('messages.' . $c['cat']) }}</button> <!-- Traducir dinámicamente -->
                        </form>
                    @endforeach
                </ul>
            </aside>

            <ul class="container-productos">
                @foreach($productos as $f)
                    @php
                        $productName = e($f->nombre);
                        $productImg = asset('assets/images/productos/' . e($f->img));
                        $id = e($f->id);
                    @endphp

                    @auth
                        <form method="POST" action="{{ route('producto') }}">
                            @csrf
                            <input type="hidden" name="idProdSelecCarta" value="{{ $id }}">
                            <button type="submit" class="container-producto">
                                <img class="imagen-producto" src="{{ $productImg }}" alt="{{ $productName }}">
                                <span>{{ __('messages.' . $productName) }}</span>
                            </button>
                        </form>
                    @else
                        <button onclick="window.location.href='{{ route('login') }}'" class="container-producto">
                            <img class="imagen-producto" src="{{ $productImg }}" alt="{{ $productName }}">
                            <span>{{ __('messages.' . $productName) }}</span>
                        </button>
                    @endauth
                @endforeach
            </ul>
        </main>
    @endsection
