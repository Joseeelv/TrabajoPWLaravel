@extends('layouts.app') <!-- Usa tu layout base -->

@section('content')
    <h1>Resumen de Transacciones</h1>

    <table border='1'>
        <tr>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Balance (€)</th>
        </tr>
        <tr style="font-weight: bold;">
            <td>Total</td>
            <td>
                Ventas: {{ formatCurrency($total_ventas) }} | 
                Compras: {{ formatCurrency($total_compras) }}
            </td>
            <td>{{ formatCurrency($balance_final) }}</td>
        </tr>

        @forelse ($transactions as $row)
            <tr style="background-color: {{ $row->transaction_type === 'Compra' ? '#FDE3E3' : '#E3FDE3' }}">
                <td>{{ $row->transaction_date }}</td>
                <td>{{ $row->transaction_type }}</td>
                <td>{{ formatCurrency($row->balance) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No hay transacciones registradas.</td>
            </tr>
        @endforelse
    </table>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/reabastecer.css') }}">
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