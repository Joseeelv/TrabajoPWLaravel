@extends('layouts.app')

@section('title', __('messages.Gestionar Reseñas'))

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/review.css') }}">
@endsection

@section('content')
    <main class="review-page">
        <h1>{{ __('messages.Reseñas de Clientes') }}</h1>

        @if (session('mensaje'))
            <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif

        <ul class="review-list">
            @forelse ($reviews as $review)
                <li class="review-item">
                    <strong>{{ $review->customer->user->username ?? __('messages.Usuario Anónimo') }}</strong> -
                    <span class="rating">⭐ {{ $review->rating }}/5</span>
                    <p>{{ $review->review_text }}</p>
                    <small>{{ $review->review_date }}</small>

                    @if ($review->answer_text)
                        <div class="manager-response">
                            <strong>{{ __('messages.Respuesta del Manager:') }}</strong>
                            <p>{{ $review->answer_text }}</p>
                        </div>
                    @else
                        <a href="{{ route('manager.reviews.respond.form', $review->review_id) }}" class="button-link">{{ __('messages.Responder') }}</a>
                    @endif
                </li>
            @empty
                <li>{{ __('messages.No hay reseñas todavía.') }}</li>
            @endforelse
        </ul>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reviews.css') }}">
@endpush
