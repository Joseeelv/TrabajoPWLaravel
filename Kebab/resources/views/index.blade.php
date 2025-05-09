@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('assets/css/carrusel.css') }}">
@section('content')

<main>
    <div class="carousel-container">
        <button class="btn btn-register" onclick="window.location.href='{{ route('register', ['locale' => app()->getLocale()]) }}';">Únete a la sociedad</button>
        sociedad</button>
        <div class="carousel">
            <div class="slide"><img src="{{ asset('assets/images/carrusel/1.png') }}" alt="Kebab 1"></div>
            <div class="slide"><img src="{{ asset('assets/images/carrusel/2.png') }}" alt="Kebab 2"></div>
            <div class="slide"><img src="{{ asset('assets/images/carrusel/3.png') }}" alt="Kebab 3"></div>
        </div>
        <button class="btn btn-left" onclick="prevSlide()">&#9664;</button>
        <button class="btn btn-right" onclick="nextSlide()">&#9654;</button>
    </div>
    <script src="{{ asset('assets/js/carrusel.js') }}" defer></script>
</main>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/carrusel.css') }}">
@endpush