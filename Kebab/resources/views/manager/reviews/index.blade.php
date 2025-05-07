@extends('layouts.app')

@section('title', 'Gestionar Reseñas')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/review.css') }}">
@endsection

@section('content')
    <main class="review-page">
        <h1>Reseñas de Clientes</h1>

        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif

        <ul class="review-list">
            @forelse ($reviews as $review)
                <li class="review-item">
                    <strong>{{ $review->customer->user->username ?? 'Usuario' }}</strong> -
                    <span class="rating">⭐ {{ $review->rating }}/5</span>
                    <p>{{ $review->review_text }}</p>
                    <small>{{ $review->review_date }}</small>

                    @if ($review->answer_text)
                        <div class="manager-response">
                            <strong>Respuesta del manager:</strong>
                            <p>{{ $review->answer_text }}</p>
                        </div>
                    @else
                        <a href="{{ route('manager.reviews.respond.form', $review->review_id) }}" class="button-link">Responder</a>
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