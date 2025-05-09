@extends('layouts.app')

@section('title', __('messages.login_title'))
@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endpush

@section('content')
<main>
  <h1>{{ __('messages.login_title') }}</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="text" name="username" placeholder="{{ __('messages.username') }}" value="{{ old('username') }}" required>
    <input type="password" name="password" placeholder="{{ __('messages.password') }}" required>
    <button type="submit" name="login">{{ __('messages.login_button') }}</button>

    @if ($errors->any())
      <div class="error-container">
        @foreach ($errors->all() as $error)
          <p class="error">{{ $error }}</p>
        @endforeach
      </div>
    @endif

    @if (session('success_message'))
      <p class="success">{{ session('success_message') }}</p>
    @endif
  </form>
  <p>{{ __('messages.register_link_text') }} <a href="{{ route('register') }}">{{ __('messages.register_link_action') }}</a></p>
  <p>{{ __('messages.password_forgot_link_text') }} <a href="{{ route('password.request') }}">{{ __('messages.password_forgot_link_action') }}</a></p>
</main>
@endsection
