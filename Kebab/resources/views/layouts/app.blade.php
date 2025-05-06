<!DOCTYPE html>
<html lang="es">
  @yield('header')
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
