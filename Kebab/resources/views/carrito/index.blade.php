@extends('layouts.app')

@section('title', __('messages.Carrito'))

@section('content')
<main>
    <h1>{{ __('messages.Carrito de compra') }}</h1>
    <div class="container">
        <h2>{{ __('messages.Ofertas activas') }}:</h2>
        @foreach($ofertasActivas as $oferta)
            <ul><li>{{ __('messages.' . $oferta['of_name']) }}</li></ul>
        @endforeach

        <h2>{{ __('messages.Productos en el carrito') }}:</h2>
        @if (!empty($compra))
            <ul>
                @foreach($compra as $p)
                    <li><strong>{{ __('messages.' . $p['nombre']) }}</strong> - 
                        {{ __('messages.Precio') }}: 
                        @if ($p['precio_final'] < $p['precio'] * $p['cantidad'])
                            <span style="text-decoration: line-through; color: red;">
                                {{ formatCurrency($p['precio'] * $p['cantidad']) }}
                            </span>
                        @endif
                        {{ formatCurrency($p['precio_final']) }}

                        @if (!empty($p['lista_ingredientes']))
                            <ul>
                                @foreach ($p['lista_ingredientes'] as $ing)
                                    @if ($ing['cantidad'] == 0)
                                        <li>{{ __('messages.SIN') }} {{ $ing['nombre'] }}</li>
                                    @elseif ($ing['cantidad'] == 2)
                                        <li>{{ __('messages.EXTRA') }} {{ $ing['nombre'] }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form action="{{ route('carrito.confirmar') }}" method="POST">
                @csrf
                {{ __('messages.Precio total') }}: {{ formatCurrency($v_total) }}
                <input type="submit" value="{{ __('messages.Confirmar') }}" />
            </form>
        @else
            <p>{{ __('messages.Tu carrito está vacío.') }}</p>
        @endif
    </div>
</main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/carrito.css') }}">
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
