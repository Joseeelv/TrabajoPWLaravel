@extends('layouts.app')

@section('title', 'Menú')

<head>
    @section('header')
    <title>Menu</title>
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
            <form method="POST" action="{{ route('menu') }}">
                @csrf
                <input type="hidden" name="category" value="Ninguna">
                <button type="submit">Ninguna</button>
            </form>
            @foreach($categorias as $c)
                <form method="POST" action="{{ route('menu') }}">
                    @csrf
                    <input type="hidden" name="category" value="{{ $c['cat'] }}">
                    <button type="submit">{{ $c['cat'] }}</button>
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
                        <span>{{ $productName }}</span>
                    </button>
                </form>
            @else
                <button onclick="window.location.href='{{ route('login') }}'" class="container-producto">
                    <img class="imagen-producto" src="{{ $productImg }}" alt="{{ $productName }}">
                    <span>{{ $productName }}</span>
                </button>
            @endauth
        @endforeach
    </ul>
</main>
@endsection
