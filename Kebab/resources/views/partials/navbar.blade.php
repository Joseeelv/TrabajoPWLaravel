{{-- resources/views/components/navbar.blade.php --}}
@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    $menuItems = [];

    if ($user) {
        switch ($user->user_type) {
            case 'admin':
                $menuItems = [
                    'Inicio' => url('/admin'),
                    'Empleados' => url('/employees'),
                    'Contratar' => url('/contratar'),
                    'Perfil' => url('/perfil'),
                    'Transacciones' => url('/transactions'),
                    'Cerrar Sesión' => route('logout')
                ];
                break;
            case 'manager':
                $menuItems = [
                    'Inicio' => url('/manager'),
                    'Reabastecer' => url('/manager/replenishment'),
                    'Transacciones' => url('/transactions'),
                    'Perfil' => url('/perfil'),
                    'Cerrar Sesión' => route('logout')
                ];
                break;
            case 'customer':
                $menuItems = [
                    'Inicio' => url('/dashboard'),
                    'Ofertas' => url('/ofertas'),
                    'Carta' => url('/menu'),
                    'Carrito' => url('/carrito'),
                    'Pedidos Recientes' => url('/pedidos'),
                    'Perfil' => url('/perfil'),
                    'Cerrar Sesión' => route('logout')
                ];
                break;
        }
    } else {
        $menuItems = [
            'Inicio' => url('/'),
            'Carta' => url('/menu'),
            'Contacto' => url('/contact'),
            'Iniciar Sesión' => route('login'),
            'Registrarse' => route('register')
        ];
    }
@endphp

<header>
    <nav class="navbar">
        <h1 class="navbar-title">DÖNER KEBAB SOCIETY</h1>

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

        @if ($user && $user->user_type === 'customer')
            <div id="kebabito-container">
                <img id="kebabito-image" src="{{ asset('assets/images/logo/DKS.png') }}" alt="Kebabito image">
                <span>{{ $user->puntos ?? 0 }}</span>
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
    </nav>
</header>
