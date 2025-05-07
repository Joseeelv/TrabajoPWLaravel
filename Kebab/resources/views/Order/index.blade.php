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
        <li class="order-item">
          <h2>Pedido del {{ $order->order_date }}</h2>
          <ul class="products-list">
            @foreach ($order->items as $item)
              <li class="product-item">
                Producto: {{ $item->product->product_name }} |
                Cantidad: {{ $item->quantity }} |
                Precio: {{ $item->price }}€
              </li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>
  </section>
</main>
@endsection
