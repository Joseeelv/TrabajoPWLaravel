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
                <label for="rating">Valoración:</label>
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required />
                        <label for="star{{ $i }}" title="{{ $i }} estrellas">★</label>
                    @endfor
                </div>

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
                    @if ($review->answer_text)
                    <div class="manager-response">
                        <strong>Respuesta del encargado:</strong>
                        <p>{{ $review->answer_text }}</p>
                    </div>
                @endif
                </li>

            @empty
                <li>No hay reseñas todavía.</li>
            @endforelse
        </ul>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reviews.css') }}">
@endpush