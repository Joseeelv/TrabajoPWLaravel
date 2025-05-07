@extends('layouts.app')

@section('title', 'Ofertas')

@section('header')
    <title>Ofertas</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ofertas.css') }}">
@endsection

@section('content')
    <main>
        @if(session('mensaje'))
            <p style="color: green;">{{ session('mensaje') }}</p>
        @endif

        <ul>
            @foreach($ofertas as $f)
                <li>
                    @auth
                        <form method="POST" action="{{ route('ofertas.activar') }}">
                            @csrf
                            <input type="hidden" name="Oferta" value="{{ $f->id }}">
                            <button type="submit" class="img-button">
                                <img width="100px" src="{{ asset('assets/images/productos/' . $f->img) }}" alt="">
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">
                            <img width="100px" src="{{ asset('assets/images/productos/' . $f->img) }}" alt="">
                        </a>
                    @endauth

                    <p>Oferta: {{ $f->nombre }}</p>
                    <p>Precio: {{ $f->coronas }} <img src="{{ asset('assets/images/logo/DKS.png') }}" alt="DKS" width="20px">
                    </p>
                    <p>Descuento: {{ $f->discount }}%</p>
                    <p>
                        @auth
                            {{ in_array($f->id, $activas) ? 'Activa' : 'No activa' }}
                        @else
                            <a href="{{ route('login') }}">Inicia sesión para activar</a>
                        @endauth
                    </p>
                </li>
            @endforeach
        </ul>
    </main>
@endsection



@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/ofertas.css') }}">
@endpush