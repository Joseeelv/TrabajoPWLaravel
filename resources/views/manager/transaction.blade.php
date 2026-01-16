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
                Ventas: {{ number_format($total_ventas, 2) }}€ | 
                Compras: {{ number_format($total_compras, 2) }}€
            </td>
            <td>{{ number_format($balance_final, 2) }}€</td>
        </tr>

        @forelse ($transactions as $row)
            <tr style="background-color: {{ $row->transaction_type === 'Compra' ? '#FDE3E3' : '#E3FDE3' }}">
                <td>{{ $row->transaction_date }}</td>
                <td>{{ $row->transaction_type }}</td>
                <td>{{ number_format($row->balance, 2) }}€</td>
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