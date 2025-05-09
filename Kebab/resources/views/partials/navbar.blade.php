@php
    use Illuminate\Support\Facades\Auth;
@endphp

<header>
    <nav class="navbar">
            <img id="logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo DKS">

            @auth
                @php
                    $user = Auth::user();
                    $userType = $user->user_type ?? null;

                    $menuItems = match ($userType) {
                        'admin' => [
                            'Inicio' => url('/adminPanel'),
                            'Empleados' => url('/adminPanel/empleados'),
                            'Contratar' => url('/adminPanel/contratar'),
                            'Perfil' => url('/perfil'),
                            'Transacciones' => url('/manager/transactions'),
                            'Cerrar Sesión' => route('logout'),
                        ],
                        'manager' => [
                            'Inicio' => url('/manager'),
                            'Reabastecer' => url('/manager/replenishment'),
                            'Transacciones' => url('/manager/transactions'),
                            'Reseñas' => url('/manager/reviews'),
                            'Perfil' => url('/perfil'),
                            'Cerrar Sesión' => route('logout'),
                        ],
                        'customer' => [
                            'Inicio' => url('/dashboard'),
                            'Ofertas' => url('/ofertas'),
                            'Carta' => url('/menu'),
                            'Carrito' => url('/carrito'),
                            'Pedidos Recientes' => url('/pedidos'),
                            'Perfil' => url('/perfil'),
                            'Reseñas' => url('/reviews'),
                            'Cerrar Sesión' => route('logout'),
                        ],
                        default => [],
                    };
                @endphp

                @foreach ($menuItems as $label => $url)
                    @if ($label === 'Cerrar Sesión')
                        <a href="{{ route('logout') }}" class="menu-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ $label }}
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ $url }}" class="menu-link">{{ $label }}</a>
                    @endif
                @endforeach

                @if ($userType === 'customer')
                    <div id="kebabito-container">
                        <img id="kebabito-image" src="{{ asset('assets/images/logo/DKS.png') }}" alt="Kebabito image">
                        @if(session()->has('points'))
                            <span>{{ session('points') }}</span>
                        @endif
                    </div>

                    @php
                        $img = $user->img_src ?? 'default.jpg';
                        $imagePath = public_path("assets/images/perfiles/$img");
                        $imageUrl = file_exists($imagePath)
                            ? asset("assets/images/perfiles/$img")
                            : asset("assets/images/perfiles/default.jpg");
                    @endphp

                    <img id="profile-image" src="{{ $imageUrl }}" alt="Profile Image">
                @endif

            @else
                @php
                    $menuItems = [
                        'Inicio' => url('/'),
                        'Carta' => url('/menu'),
                        'Contacto' => url('/contact'),
                        'Iniciar Sesión' => route('login'),
                        'Registrarse' => route('register'),
                    ];
                @endphp

                @foreach ($menuItems as $label => $url)
                    <a href="{{ $url }}" class="menu-link">{{ $label }}</a>
                @endforeach
            @endauth
    </nav>
</header>

@push('scripts')
<script src="{{ asset('assets/js/previewFoto.js') }}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const langBtn = document.getElementById('lang-btn');
        const langDropdown = document.getElementById('lang-dropdown');

        langBtn.addEventListener('click', function () {
            const isVisible = langDropdown.style.display === 'block';
            langDropdown.style.display = isVisible ? 'none' : 'block';
        });

        document.addEventListener('click', function (event) {
            if (!langBtn.contains(event.target) && !langDropdown.contains(event.target)) {
                langDropdown.style.display = 'none';
            }
        });
    });
</script>
@endpush