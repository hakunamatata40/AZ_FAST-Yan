@extends('layout.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/client/index.css') }}">
@endsection

@section('content')
@if (auth()->check())
<header class="main-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="/client/dashboard">
            <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo">
        </a>

        <!-- User Menu -->
        <div class="wallet" onclick="location.href='{{ route('wallet.transaction.form') }}'">
            <div class="wallet-card">
                <a href="{{ route('wallet.transaction.form') }}" class="wallet-btn" style="text-decoration: none; font-weight: bold;">
                    <i class="fas fa-wallet"></i> <p class="wallet-amount">{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</p>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Wallet Card -->

@else
<div class="guest-banner">
    <h1>Bienvenue, invité!</h1>
    <p>Veuillez vous connecter pour accéder à votre tableau de bord.</p>
</div>
@endif

<!-- Products Section -->
<div class="products-container">
    <h1 class="products-title">Produits selon vos centres d'intérêt</h1>
    
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card" onclick="location.href='{{ route('products.description', $product->id) }}'">
                @if($product->discount > 0)
                    <span class="product-badge">-{{ $product->discount }}%</span>
                @endif
                
                <!-- Product Image -->
                <div class="product-image-container">
                    @if($product->images->count())
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <div class="product-image bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
                    <p class="product-price">{{ number_format($product->price, 2) }} FCFA</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection