@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/reabastecer.css') }}">

<div class="container" style="display: flex; align-items: center; flex-direction: column;">
    <h1>{{ __('messages.Reabastecer productos') }}</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="tables">
        {{-- Ingredientes --}}
        <div id="table1">
            <h2>{{ __('messages.Stock de ingredientes') }}</h2>
            <table>
                <tr>
                    <th></th>
                    <th>{{ __('messages.Nombre') }}</th>
                    <th>{{ __('messages.Precio unitario') }}</th>
                    <th>{{ __('messages.Stock') }}</th>
                    <th>{{ __('messages.Cantidad') }}</th>
                    <th>{{ __('messages.Pedir') }}</th>
                </tr>
                @forelse($ingredients as $ing)
                <tr>
                    <td><img src="{{ asset('assets/images/ingredientes/' . $ing->img_src) }}" alt="{{ $ing->ingredient_name }}"></td>
                    <td>{{ __('messages.' . $ing->ingredient_name) }}</td>
                    <td>{{ formatCurrency($ing->cost) }}</td>
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
                <tr>
                    <td colspan="6">{{ __('messages.No hay ingredientes') }}</td>
                </tr>
                @endforelse
            </table>
        </div>

        {{-- Productos --}}
        <div id="table2">
            <h2>{{ __('messages.Stock de productos') }}</h2>
            <table>
                <tr>
                    <th></th>
                    <th>{{ __('messages.Nombre') }}</th>
                    <th>{{ __('messages.Precio unitario') }}</th>
                    <th>{{ __('messages.Stock') }}</th>
                    <th>{{ __('messages.Cantidad') }}</th>
                    <th>{{ __('messages.Pedir') }}</th>
                </tr>
                @forelse($products as $prod)
                <tr>
                    <td><img src="{{ asset('assets/images/productos/' . $prod->img_src) }}" alt="{{ __('messages.'. $prod->product_name) }}"></td>
                    <td>{{ __('messages.'. $prod->product_name) }}</td>
                    <td>{{ formatCurrency($prod->cost) }}</td>

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
                <tr>
                    <td colspan="6">{{ __('messages.No hay productos') }}</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection

@php
function formatCurrency($amount) {
    $locale = app()->getLocale();
    $currencySymbol = $locale === 'tr' ? '₺' : '€';
    $conversionRate = $locale === 'tr' ? 20 : 1; // Ejemplo: 1€ = 20₺
    $convertedAmount = $amount * $conversionRate;
    return number_format($convertedAmount, 2) . ' ' . $currencySymbol;
}
@endphp
