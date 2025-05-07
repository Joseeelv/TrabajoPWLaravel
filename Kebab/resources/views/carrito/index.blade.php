@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
<main>
    <h1>Carrito de compra</h1>
    <div class="container">
        <h2>Ofertas activas:</h2>
        @foreach($ofertasActivas as $oferta)
            <ul><li>{{ $oferta['of_name'] }}</li></ul>
        @endforeach

        <h2>Productos en el carrito:</h2>
        @if (!empty($compra))
            <ul>
                @foreach($compra as $p)
                    <li><strong>{{ $p['nombre'] }}</strong> - 
                        Precio: 
                        @if ($p['precio_final'] < $p['precio'] * $p['cantidad'])
                            <span style="text-decoration: line-through; color: red;">
                                {{ number_format($p['precio'] * $p['cantidad'], 2) }} €
                            </span>
                        @endif
                        {{ number_format($p['precio_final'], 2) }} €

                        @if (!empty($p['lista_ingredientes']))
                            <ul>
                                @foreach ($p['lista_ingredientes'] as $ing)
                                    @if ($ing['cantidad'] == 0)
                                        <li>SIN {{ $ing['nombre'] }}</li>
                                    @elseif ($ing['cantidad'] == 2)
                                        <li>EXTRA {{ $ing['nombre'] }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form action="{{ route('carrito.confirmar') }}" method="POST">
                @csrf
                Precio total: {{ number_format($v_total, 2) }} €
                <input type="submit" value="Confirmar" />
            </form>
        @else
            <p>Tu carrito está vacío.</p>
        @endif
    </div>
</main>
@endsection
