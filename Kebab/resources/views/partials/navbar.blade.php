@php
    use Illuminate\Support\Facades\Auth;
@endphp

<header>
    <nav class="navbar">
        <h1 class="navbar-title">DÖNER KEBAB SOCIETY</h1>

        @auth
            @php
                $user = Auth::user();
                $userType = $user->user_type ?? null;

                $menuItems = match($userType) {
                    'admin' => [
                        'Inicio' => url('/admin'),
                        'Empleados' => url('/employees'),
                        'Contratar' => url('/contratar'),
                        'Perfil' => url('/perfil'),
                        'Transacciones' => url('/transactions'),
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
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="menu-link" style="background:none;border:none;cursor:pointer;">
                            {{ $label }}
                        </button>
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
