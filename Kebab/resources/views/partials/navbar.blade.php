@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $userType = $user->user_type ?? null;
    $locale = app()->getLocale();
    $menuItems = [];

    // Determinar el menú en función del tipo de usuario
    switch ($userType) {
        case 'admin':
            $menuItems = [
                __('messages.inicio') => url('/adminPanel'),
                __('messages.empleados') => url('/adminPanel/empleados'),
                __('messages.contratar') => url('/adminPanel/contratar'),
                __('messages.perfil') => url('/perfil'),
                __('messages.transacciones') => url('/manager/transactions'),
                __('messages.cerrar_sesion') => route('logout'),
            ];
            break;
        case 'manager':
            $menuItems = [
                __('messages.inicio') => url('/manager'),
                __('messages.reabastecer') => url('/manager/replenishment'),
                __('messages.transacciones') => url('/manager/transactions'),
                __('messages.reseñas') => url('/manager/reviews'),
                __('messages.perfil') => url('/perfil'),
                __('messages.cerrar_sesion') => route('logout'),
            ];
            break;
        case 'customer':
            $menuItems = [
                __('messages.inicio') => url('/dashboard'),
                __('messages.ofertas') => url('/ofertas'),
                __('messages.menu') => url('/menu'),
                __('messages.carrito') => url('/carrito'),
                __('messages.pedidos_recientes') => url('/pedidos'),
                __('messages.perfil') => url('/perfil'),
                __('messages.reseñas') => url('/reviews'),
                __('messages.cerrar_sesion') => route('logout'),
            ];
            break;
        default:
            $menuItems = [
                __('messages.inicio') => url('/'),
                __('messages.menu') => url('/menu'),
                __('messages.contacto') => url('/contacto'),
                __('messages.iniciar_sesion') => route('login'),
                __('messages.registrarse') => route('register'),
            ];
            break;
    }
@endphp

<header>
    <nav class="navbar">
        <img id="logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo DKS">

        @auth
            @foreach ($menuItems as $label => $url)
                @if ($label === __('messages.cerrar_sesion'))
                    <a href="{{ route('logout') }}" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ $label }}
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ $url }}" class="menu-link">{{ $label }}</a>
                @endif
            @endforeach
        @else
            @foreach ($menuItems as $label => $url)
                <a href="{{ $url }}" class="menu-link">{{ $label }}</a>
            @endforeach
        @endauth

        <div id="lang-selector" style="position: relative;">
            <button id="lang-btn" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('assets/images/flags/traduccion.png') }}" alt="Language Selector" style="width: 30px; height: 30px;">
            </button>
            <div id="lang-dropdown" style="display: none; position: absolute; top: 40px; right: 0; background: white; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000;">
            <a href="{{ route('cambiar.idioma', ['locale' => 'es']) }}" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: {{ $locale === 'es' ? 'blue' : 'black' }};">
                <img src="{{ asset('assets/images/flags/es.webp') }}" alt="Español" style="width: 20px; height: 20px; margin-right: 10px;"> Español
            </a>
            <a href="{{ route('cambiar.idioma', ['locale' => 'tr']) }}" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: {{ $locale === 'tr' ? 'blue' : 'black' }};">
                <img src="{{ asset('assets/images/flags/tr.webp') }}" alt="Türkçe" style="width: 20px; height: 20px; margin-right: 10px;"> Türkçe
            </a>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
<script src="{{ asset('assets/js/previewFoto.js') }}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const langBtn = document.getElementById('lang-btn');
        const langDropdown = document.getElementById('lang-dropdown');

        langBtn.addEventListener('click', function() {
            const isVisible = langDropdown.style.display === 'block';
            langDropdown.style.display = isVisible ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            if (!langBtn.contains(event.target) && !langDropdown.contains(event.target)) {
                langDropdown.style.display = 'none';
            }
        });
    });
</script>
@endpush
