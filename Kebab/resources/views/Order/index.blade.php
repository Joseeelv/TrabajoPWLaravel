@extends('layouts.app')

@section('head')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Pedidos</title>
<link rel="stylesheet" href="../assets/css/styles.css">
<link rel="stylesheet" href="../assets/css/pedidos.css">
@endsection

@section('content')
<main class="main-container">
  <section class="orders-container">
    <h1>Mis Pedidos</h1>
    <ul class="orders-list">
      @foreach ($orders as $order)
        <h3>Pedido #{{ $order->order_id }} ({{ $order->order_date }})</h3>
        <ul>
            @foreach ($order->items as $item)
                <li>
                    Producto: {{ $item->product->product_name ?? 'Producto no encontrado' }}<br>
                    Cantidad: {{ $item->quantity }}<br>
                    Precio: {{ $item->price }} €
                </li>
            @endforeach
        </ul>
      @endforeach
    </ul>
  </section>
</main>
@endsection
