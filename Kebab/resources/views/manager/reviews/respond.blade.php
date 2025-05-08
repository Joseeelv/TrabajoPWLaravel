@extends('layouts.app')

@section('title', 'Responder Reseña')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/review.css') }}">
@endsection

@section('content')
    <main class="review-page">
        <h1>Responder a la Reseña</h1>

        <div class="review-item">
            <p><strong>{{ $review->customer->user->username ?? 'Usuario' }}:</strong> {{ $review->review_text }}</p>
        </div>

        <form action="{{ route('manager.reviews.respond', $review->review_id) }}" method="POST" class="review-form">
            @csrf
            <div class="form-group">
                <label for="answer_text">Tu respuesta:</label>
                <textarea name="answer_text" rows="4" required></textarea>
            </div>
            <button type="submit">Enviar respuesta</button>
        </form>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reviews.css') }}">
@endpush