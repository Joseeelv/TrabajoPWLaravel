@extends('layouts.app')

@section('header')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ __('messages.Mis Pedidos') }}</title>
<link rel="stylesheet" href="../assets/css/styles.css">
@endsection

@section('content')
<main class="main-container">
  <section class="orders-container">
    <h1>{{ __('messages.my_orders') }}</h1>
    <ul class="orders-list">
      @foreach ($orders as $order)
        <h3>{{ __('messages.order_number') }}{{ $order->order_id }} ({{ $order->order_date }})</h3>
        <ul>
            @foreach ($order->items as $item)
                <li>
                    {{ __('messages.product') }}: {{ __('messages.' . $item->product->product_name) ?? __('messages.Producto no encontrado') }}<br>
                    {{ __('messages.quantity') }}: {{ $item->quantity }}<br>
                    {{ __('messages.price') }}: {{ formatCurrency($item->price) }}
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
    
    // Definir los símbolos y tasas de conversión de manera más flexible
    $currencies = [
        'es' => ['symbol' => '€', 'rate' => 1],  // Euro para español
        'tr' => ['symbol' => '₺', 'rate' => 20], // Lira turca para turco
    ];

    $currencySymbol = $currencies[$locale]['symbol'] ?? '€'; // Si no se encuentra, por defecto €
    $conversionRate = $currencies[$locale]['rate'] ?? 1;   // Si no se encuentra, por defecto 1 (sin conversión)
    
    // Convertir y formatear el monto
    $convertedAmount = $amount * $conversionRate;
    return number_format($convertedAmount, 2) . ' ' . $currencySymbol;
}
@endphp