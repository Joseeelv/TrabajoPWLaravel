@extends('layouts.app')

@section('title', __('messages.Producto'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/producto.css') }}">
@endpush

@section('content')
<main>
    <div class="product-container">
        <div class="prod-image">
            @php
                $imgPath = public_path('assets/images/productos/' . basename($producto->img_src));
            @endphp
            @if (file_exists($imgPath))
                <img src="{{ asset('assets/images/productos/' . basename($producto->img_src)) }}" alt="{{ __('messages.' . $producto->product_name) }}">
            @else
                <p>{{ __('messages.Imagen no disponible') }}</p>
            @endif
        </div>

        <p>{{ __('messages.' . $producto->product_name )}}</p>
        <p>{{ $producto->product_price }} €</p>

        <div class="allergens-container">
            @if (!empty($alergenos))
                <p>{{ __('messages.Alérgenos:') }}</p>
                <div class="allergens-list">
                    @foreach ($alergenos as $alergeno)
                        @php
                            $alergenoPath = public_path('assets/images/alergenos/' . basename($alergeno));
                        @endphp
                        @if (file_exists($alergenoPath))
                            <img src="{{ asset('assets/images/alergenos/' . basename($alergeno)) }}" alt="{{ __('messages.Alergeno') }}" class="allergen-img">
                        @else
                            <p>{{ __('messages.Imagen no disponible') }}</p>
                        @endif
                    @endforeach
                </div>
            @else
                <p>{{ __('messages.No contiene alérgenos.') }}</p>
            @endif
        </div>

        <form id="form_add_carrito" action="{{ url('add-to-cart') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $producto->product_id }}">
            <input type="hidden" name="product_name" value="{{ __('messages.' .$producto->product_name) }}">
            <input type="hidden" name="product_price" value="{{ __('messages.' . $producto->product_price) }}">
            <input type="hidden" id="ingr_list_info" name="ingr_list_info">
            <input type="hidden" name="category" value="{{ __('messages.' . $producto->category) }}">
            <button id="add_to_carrito" type="submit">{{ __('messages.Añadir a carrito') }}</button>
        </form>

        <div class="ingredients-container">
            @foreach ($ingredientes as $ingrediente)
                <div class="ingredient-container">
                    @php
                        $imgPath = public_path('assets/images/ingredientes/' . basename($ingrediente->img_src));
                    @endphp
                    @if (file_exists($imgPath))
                        <img src="{{ asset('assets/images/ingredientes/' . basename($ingrediente->img_src)) }}" alt="{{ $ingrediente->ingredient_name }}">
                    @else
                        <p>{{ __('messages.Imagen no disponible') }}</p>
                    @endif

                    <p class="ingr-nombre">{{ __('messages.' . $ingrediente->ingredient_name)}}</p>
                    <div class="ingr-buttons">
                        <button class="ingr_btn">-</button>
                        <span class="ingr-cant">1</span>
                        <button class="ingr_btn">+</button>
                        <p class="ingr-id" hidden>{{ $ingrediente->ingredient_id }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
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