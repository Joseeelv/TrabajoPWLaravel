<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Döner Kebab Society')</title>
    <link rel="icon" href="{{ asset('assets/images/logo/DKS.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    @stack('scripts')
</body>
</html>
