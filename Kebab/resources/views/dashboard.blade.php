<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebab Society</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/carrusel.css') }}">
    <script src="{{ asset('assets/js/carrusel.js') }}" defer></script>
</head>
<body>
    <header>
        @include('partials.navbar')
    </header>
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
    @include('partials.footer')
</body>
</html>
