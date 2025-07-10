@extends('layout.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/client/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<style>
    :root {
        --primary: #059669;
        --primary-dark: #047857;
        --secondary: #10B981;
        --accent: #EF4444;
        --text: #1F2937;
        --text-light: #6B7280;
        --bg-gray: #F9FAFB;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--bg-gray);
        color: var(--text);
    }

    .main-header {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .logo {
        height: 60px;
        transition: var(--transition);
    }

    .logo:hover {
        transform: scale(1.05);
    }

    /* Wallet Card */
    .wallet-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 12px;
        padding: 3px;
        color: white;
        margin: 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .wallet-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .wallet-btn {
        background: white;
        color: var(--primary);
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
    }

    .wallet-btn:hover {
        background: rgba(255, 255, 255, 0.9);
    }

    /* Products Section */
    .products-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .products-title {
        font-size: 28px;
        font-weight: 700;
        margin: 30px 0;
        position: relative;
        display: inline-block;
        color: var(--text);
    }

    .products-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--accent);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
    }

    .product-image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-details {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text);
        line-height: 1.3;
    }

    .product-description {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 12px;
        line-height: 1.4;
        flex-grow: 1;
    }

    .product-price-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .product-price {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
    }

    .product-btn {
        padding: 8px 16px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        margin-top: 12px;
    }

    .product-btn:hover {
        background: var(--primary-dark);
    }

    /* Empty state */
    .empty-products {
        text-align: center;
        padding: 40px 0;
        color: var(--text-light);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 25px;
            margin-bottom: 24px;
        }
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .product-image-container {
            height: 160px;
        }

        .header-container {
            padding: 0 15px;
        }

        .logo {
            height: 50px;
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 10px;
        }

        .products-title {
            font-size: 24px;
        }
    }
</style>

@if (auth()->check())
<header class="main-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="/client/dashboard">
            <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo">
        </a>

        <!-- Wallet -->
        <div class="wallet-card" onclick="location.href='{{ route('wallet.transaction.form') }}'">
            <a href="{{ route('wallet.transaction.form') }}" class="wallet-btn" style="text-decoration: none;">
                <i class="fas fa-wallet"></i> {{ number_format(auth()->user()->wallet->balance, 2) }} FCFA
            </a>
        </div>
    </div>
</header>
@else
<div class="guest-banner">
    <h1>Bienvenue, invité!</h1>
    <p>Veuillez vous connecter pour accéder à votre tableau de bord.</p>
</div>
@endif

<!-- Products Section -->
<div class="products-container">
    <h1 class="products-title">Nos Produits</h1>
    
    @if($products->count() > 0)
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card" onclick="location.href='{{ route('products.description', $product->id) }}'">
                @if($product->discount > 0)
                    <span class="product-badge">-{{ $product->discount }}%</span>
                @endif
                
                <!-- Product Image -->
                <div class="product-image-container">
                    @if($product->images->count())
                        <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <div class="product-image bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                    
                    <div class="product-price-container">
                        <p class="product-price">{{ number_format($product->price, 2) }} FCFA</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="empty-products">
        <i class="fas fa-box-open fa-3x" style="color: #e5e7eb; margin-bottom: 15px;"></i>
        <h3>Aucun produit disponible pour le moment</h3>
        <p>Revenez plus tard pour découvrir nos nouveautés</p>
    </div>
    @endif
</div>
@endsection