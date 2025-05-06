@extends('layouts.app')

@section('title', 'Menú')

<head>
    @section('header')
    <title>Menu</title>
    <link rel="icon" href="../assets/images/logo/DKS.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
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

            @if(session()->has('user_id'))
                <form method="POST" action="{{ url('/producto') }}">
                    @csrf
                    <input type="hidden" name="idProdSelecCarta" value="{{ $id }}">
                    <button type="submit" class="container-producto">
                        <img class="imagen-producto" src="{{ $productImg }}" alt="{{ $productName }}">
                        <span>{{ $productName }}</span>
                    </button>
                </form>
            @else
                <button onclick="window.location.href='{{ url('/login') }}'" class="container-producto">
                    <img class="imagen-producto" src="{{ $productImg }}" alt="{{ $productName }}">
                    <span>{{ $productName }}</span>
                </button>
            @endif
        @endforeach
    </ul>
</main>
@endsection