@extends('layouts.app')

@section('content')
    <main>
        @if(session('message'))
            <p>{{ session('message') }}</p>
        @endif

        <ul>
            @foreach ($offers as $offer)
                <li>
                    <form method="POST" action="{{ route('ofertas.activar') }}">
                        @csrf
                        <input type="hidden" name="Oferta" value="{{ $offer->offer_id }}">
                        <input type="image" width="100px"
                            src="{{ asset('assets/images/productos/' . $offer->product->img_src) }}" alt="">
                    </form>
                    <p>{{ __('messages.Oferta') }}: {{ __('messages.' .  $offer->product->product_name) }}</p>
                    <p>{{ __('messages.Precio') }}: {{ $offer->cost }} <img src="{{ asset('assets/images/logo/DKS.png') }}" alt='DKS Logo'
                            width='20px'></p>
                    <p>{{ __('messages.Descuento') }}: {{ $offer->discount }}%</p>
                    <p>{{ $offer->customers->contains($user->user_id) ? __('messages.Activa') : __('messages.No Activa') }}</p>
                </li>
            @endforeach
        </ul>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/ofertas.css') }}">
@endpush
