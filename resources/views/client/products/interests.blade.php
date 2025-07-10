@extends('layout.app')

<style>
    .product-category {
    font-size: 0.875rem;
    color: #6b7280;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.empty-products {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-top: 2rem;
}

.empty-products h3 {
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-products p {
    color: #6b7280;
    margin-bottom: 1.5rem;
}

.btn-primary {
    background-color: #4361ee;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #3a56d4;
    transform: translateY(-2px);
}
</style>

@section('styles')
<link rel="stylesheet" href="{{ asset('css/client/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                             alt="{{ $product->name }}" 
                             class="product-image">
                    @else
                        <div class="product-image bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-category">{{ $product->category->name ?? 'Non catégorisé' }}</p>
                    <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
                    <p class="product-price">{{ number_format($product->price, 2) }} FCFA</p>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="empty-products">
        <i class="fas fa-box-open fa-3x" style="color: #e5e7eb; margin-bottom: 15px;"></i>
        <h3>Aucun produit trouvé correspondant à vos centres d'intérêt</h3>
        <p>Nous vous suggérons de mettre à jour vos préférences dans votre profil</p>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Scripts supplémentaires si nécessaire
</script>
@endsection