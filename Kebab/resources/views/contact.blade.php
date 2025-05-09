@extends('layouts.app')

@section('title', __('messages.title'))

<head>
    @section('header')
    <meta charset="UTF-8">
    <title>{{ __('messages.title') }}</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contacto.css') }}">
    @show
</head>
@section('content')

    <body>

        <main>
            <h1>{{ __('messages.title') }}</h1>
            <div class="contacto">
                <div>
                    <h4>{{ __('messages.phone_text') }}</h4>
                    <h2>{{ __('messages.phone') }}</h2>
                </div>
                <div>
                    <h4>{{ __('messages.email_text') }}</h4>
                    <h2>{{ __('messages.email') }}</h2>
                </div>
                <div>
                    <h4>{{ __('messages.social_media_text') }}</h4>
                    <div id="redes">
                        <a href="https://www.facebook.com/andreualexander" target="_blank"><button>{{ __('messages.facebook') }}</button></a>
                        <a href="https://twitter.com/andreualexander" target="_blank"><button>{{ __('messages.twitter') }}</button></a>
                        <a href="https://www.instagram.com/andreualexander/" target="_blank"><button>{{ __('messages.instagram') }}</button></a>
                    </div>
                </div>
            </div>

            <div class="contacto">
                <div>
                    <h4>{{ __('messages.address_text') }}</h4>
                    <h2>{{ __('messages.address') }}</h2>
                </div>
            </div>

            <iframe
                src="{{ app()->getLocale() === 'tr' ? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3208.887560810223!2d-6.208745023929023!3d36.46027348678712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dcd3ab65f80c7%3A0xaca580cfc8f97d98!2sAv.%20Al-Andalus%2C%2012%2C%2011100%20San%20Fernando%2C%20Cádiz!5e0!3m2!1str!2str!4v1742634507016!5m2!1str!2str' : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3208.887560810223!2d-6.208745023929023!3d36.46027348678712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dcd3ab65f80c7%3A0xaca580cfc8f97d98!2sAv.%20Al-Andalus%2C%2012%2C%2011100%20San%20Fernando%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1742634507016!5m2!1ses!2ses' }}"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </main>

@endsection
