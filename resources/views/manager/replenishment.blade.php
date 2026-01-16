@extends('layouts.app') {{-- o el layout que uses --}}

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/reabastecer.css') }}">

<div class="container">
    <h1>Reabastecer productos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="tables">
        {{-- Ingredientes --}}
        <div id="table1">
            <h2>Stock de ingredientes</h2>
            <table>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Precio unitario</th>
                    <th>Stock</th>
                    <th>Cantidad</th>
                    <th>Pedir</th>
                </tr>
                @forelse($ingredients as $ing)
                    <tr>
                        <td><img src="{{ asset('assets/images/ingredientes/' . $ing->img_src) }}" alt="{{ $ing->ingredient_name }}"></td>
                        <td>{{ $ing->ingredient_name }}</td>
                        <td>{{ $ing->cost }} €</td>
                        <td>{{ $ing->stock }}</td>
                        <td>
                            <form method="POST" action="{{ route('manager.replenishment.store') }}">
                                @csrf
                                <input type="hidden" name="ingredient_id" value="{{ $ing->ingredient_id }}">
                                <input type="hidden" name="cost" value="{{ $ing->cost }}">
                                <input type="number" name="quantity" value="10" min="1" max="{{ floor(999.99 / $ing->cost) }}" required>
                        </td>
                        <td>
                            <input type="submit" value="+">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">No hay ingredientes</td></tr>
                @endforelse
            </table>
        </div>

        {{-- Productos --}}
        <div id="table2">
            <h2>Stock de productos</h2>
            <table>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Precio unitario</th>
                    <th>Stock</th>
                    <th>Cantidad</th>
                    <th>Pedir</th>
                </tr>
                @forelse($products as $prod)
                    <tr>
                        <td><img src="{{ asset('assets/images/productos/' . $prod->img_src) }}" alt="{{ $prod->product_name }}"></td>
                        <td>{{ $prod->product_name }}</td>
                        <td>{{ $prod->cost }} €</td>
                        <td>{{ $prod->stock }}</td>
                        <td>
                            <form method="POST" action="{{ route('manager.replenishment.store') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $prod->product_id }}">
                                <input type="hidden" name="cost" value="{{ $prod->cost }}">
                                <input type="number" name="quantity" value="10" min="1" max="{{ floor(999.99 / $prod->cost) }}" required>
                        </td>
                        <td>
                            <input type="submit" value="+">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">No hay productos</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection
