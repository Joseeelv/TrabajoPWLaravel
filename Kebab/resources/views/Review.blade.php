@extends('layouts.app')

@section('title', 'Reseñas')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/review.css') }}">
@endsection

@section('content')
<main class="review-page">
    <h1>Deja tu reseña</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    @auth
        <form action="{{ route('reviews.store') }}" method="POST" class="review-form">
            @csrf
            <label for="rating">Valoración (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>

            <label for="review_text">Comentario:</label>
            <textarea name="review_text" rows="4" placeholder="Escribe tu opinión..."></textarea>

            <button type="submit">Enviar reseña</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Inicia sesión</a> para dejar una reseña.</p>
    @endauth

    <hr>

    <h2>Reseñas de otros usuarios</h2>
    <ul class="review-list">
        @forelse ($reviews as $review)
            <li class="review-item">
                <strong>{{ $review->customer->user->username ?? 'Usuario' }}</strong> -
                <span class="rating">⭐ {{ $review->rating }}/5</span>
                <p>{{ $review->review_text }}</p>
                <small>{{ $review->review_date }}</small>
            </li>
        @empty
            <li>No hay reseñas todavía.</li>
        @endforelse
    </ul>
</main>
@endsection
