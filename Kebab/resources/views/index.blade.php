<!DOCTYPE html>
<html lang="es">
<head>
    @section('header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döner Kebab Society</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/carrusel.css') }}">
    <script src="{{ asset('assets/js/carrusel.js') }}" defer></script>
    @show
</head>
<body>
    <header>
        <nav class="navbar">
            <img id="logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo DKS">
            <a href="{{ route('home') }}" class="menu-link">Inicio</a>
            <a href="{{ url('/menu') }}" class="menu-link">Carta</a>
            <a href="{{ url('/contact') }}" class="menu-link">Contacto</a>
            <a href="{{ route('login') }}" class="menu-link">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="menu-link">Registrarse</a>
        </nav>
    </header>

    <main>
        <div class="carousel-container">
            <button class="btn btn-register" onclick="window.location.href='{{ route('register') }}';">Únete a la sociedad</button>
            <div class="carousel">
                <div class="slide"><img src="{{ asset('assets/images/carrusel/1.png') }}" alt="Kebab 1"></div>
                <div class="slide"><img src="{{ asset('assets/images/carrusel/2.png') }}" alt="Kebab 2"></div>
                <div class="slide"><img src="{{ asset('assets/images/carrusel/3.png') }}" alt="Kebab 3"></div>
            </div>
            <button class="btn btn-left" onclick="prevSlide()">&#9664;</button>
            <button class="btn btn-right" onclick="nextSlide()">&#9654;</button>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
