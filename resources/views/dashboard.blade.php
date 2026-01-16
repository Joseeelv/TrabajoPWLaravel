@extends('layouts.app')

@section('title', 'Panel de Cliente')

@section('content')
<main>
    <div class="carousel-container">
        <div class="carousel">
            <div class="slide"><img src="{{ asset('assets/images/carrusel/1.png') }}" alt="Kebab 1"></div>
            <div class="slide"><img src="{{ asset('assets/images/carrusel/2.png') }}" alt="Kebab 2"></div>
            <div class="slide"><img src="{{ asset('assets/images/carrusel/3.png') }}" alt="Kebab 3"></div>
        </div>
        <button class="btn btn-left" onclick="prevSlide()">&#9664;</button>
        <button class="btn btn-right" onclick="nextSlide()">&#9654;</button>
    </div>
    <div>
        <p>Tus puntos: {{ $points }}</p>
    </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/carrusel.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/carrusel.js') }}" defer></script>
@endpush
