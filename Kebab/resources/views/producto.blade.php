@extends('layouts.app')

@section('title', 'Producto')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/images/logo/DKS.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/producto.css">
    <title>KEBAB SOCIETY - CARTA</title>
    <script src="../assets/js/producto.js"></script>
</head>

@section('content')
<main>
    <div class="product-container">
        <div class="prod-image">
            @php
                $imgPath = public_path('assets/images/productos/' . basename($producto->img_src));
            @endphp
            @if (file_exists($imgPath))
                <img src="{{ asset('assets/images/productos/' . basename($producto->img_src)) }}" alt="{{ $producto->product_name }}">
            @else
                <p>Imagen no disponible</p>
            @endif
        </div>

        <p>{{ $producto->product_name }}</p>
        <p>{{ $producto->product_price }} €</p>

        <div class="allergens-container">
            @if (!empty($alergenos))
                <p>Alérgenos:</p>
                <div class="allergens-list">
                    @foreach ($alergenos as $alergeno)
                        @php
                            $alergenoPath = public_path('assets/images/alergenos/' . basename($alergeno));
                        @endphp
                        @if (file_exists($alergenoPath))
                            <img src="{{ asset('assets/images/alergenos/' . basename($alergeno)) }}" alt="Alergeno" class="allergen-img">
                        @else
                            <p>Imagen no disponible</p>
                        @endif
                    @endforeach
                </div>
            @else
                <p>No contiene alérgenos.</p>
            @endif
        </div>

        <form id="form_add_carrito" action="{{ url('add-to-cart') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $producto->product_id }}">
            <input type="hidden" name="product_name" value="{{ $producto->product_name }}">
            <input type="hidden" name="product_price" value="{{ $producto->product_price }}">
            <input type="hidden" id="ingr_list_info" name="ingr_list_info">
            <input type="hidden" name="category" value="{{ $producto->category }}">
            <button id="add_to_carrito" type="submit">Añadir a carrito</button>
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
                        <p>Imagen no disponible</p>
                    @endif

                    <p class="ingr-nombre">{{ $ingrediente->ingredient_name }}</p>
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
