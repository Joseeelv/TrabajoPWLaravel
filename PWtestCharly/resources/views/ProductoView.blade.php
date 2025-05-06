@section('content')
    <h1>{{ $product->nombre }}</h1>
    <p>{{ $product->descripcion }}</p>
    <p><strong>Precio:</strong> ${{ $product->precio }}</p>

    <form action="{{ route('cart.add') }}" method="GET">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="number" name="cantidad" value="1" min="1">
        <button type="submit">Agregar al carrito</button>
    </form>
@endsection
