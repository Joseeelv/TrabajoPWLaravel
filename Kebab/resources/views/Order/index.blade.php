@extends('layouts.app')

@section('header')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Pedidos</title>
<link rel="stylesheet" href="../assets/css/styles.css">
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
                    Precio: {{ formatCurrency($item->price) }}
                </li>
            @endforeach
        </ul>
      @endforeach
    </ul>
  </section>
</main>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/pedidos.css') }}">
@endpush

@php
function formatCurrency($amount) {
    $locale = app()->getLocale();
    $currencySymbol = $locale === 'tr' ? '₺' : '€';
    $conversionRate = $locale === 'tr' ? 20 : 1; // Ejemplo: 1€ = 20₺
    $convertedAmount = $amount * $conversionRate;
    return number_format($convertedAmount, 2) . ' ' . $currencySymbol;
}
@endphp