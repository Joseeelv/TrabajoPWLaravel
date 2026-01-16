@extends('layouts.app')

@section('title', 'Pedido Confirmado')

@section('content')
<main>
    <h1>Pedido Confirmado</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Su pedido ha sido confirmado. Gracias por su compra.</p>
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo DKS" class="logo">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver a la página principal</a>
            </div>
        </div>
    </div>
</main>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/carrito.css') }}">
@endpush