@extends('layout.app')

@section('styles')
<style>
    .cart-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }
    
    .cart-items {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .cart-item {
        display: flex;
        gap: 2rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .cart-item-image {
        width: 120px;
        height: 120px;
        object-fit: contain;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    .cart-item-details {
        flex: 1;
    }
    
    .cart-item-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .cart-item-price {
        font-weight: 700;
        color: #4361ee;
        margin-bottom: 1rem;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .quantity-input {
        width: 60px;
        text-align: center;
        padding: 0.5rem;
        border: 1px solid #e9ecef;
        border-radius: 6px;
    }
    
    .update-btn {
        background: #4361ee;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .update-btn:hover {
        background: #3a56d4;
    }
    
    .remove-btn {
        background: #ef233c;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .remove-btn:hover {
        background: #d90429;
    }
    
    .cart-summary {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }
    
    .summary-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .summary-total {
        font-size: 1.25rem;
        font-weight: 700;
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
        margin-top: 1rem;
    }
    
    .checkout-btn {
        display: block;
        width: 100%;
        background: #38b000;
        color: white;
        text-align: center;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        margin-top: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .checkout-btn:hover {
        background: #2d9e00;
    }
    
    .empty-cart {
        text-align: center;
        padding: 4rem 0;
    }
    
    .empty-cart-icon {
        font-size: 3rem;
        color: #adb5bd;
        margin-bottom: 1rem;
    }
    
    .empty-cart-text {
        font-size: 1.25rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }
    
    .continue-shopping {
        display: inline-block;
        background: #4361ee;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .continue-shopping:hover {
        background: #3a56d4;
    }
</style>
@endsection

@section('content')
<div class="cart-container">
    <h1>Votre Panier</h1>
    
    @if(count($products) > 0)
        <div class="cart-items">
            @foreach($products as $item)
                <div class="cart-item">
                    @if($item['product']->images->count())
                        <img src="{{ asset('storage/' . $item['product']->images->first()->image_path) }}" 
                            alt="{{ $item['product']->name }}" 
                            class="cart-item-image">
                    @else
                        <div class="product-image bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                        </div>

                    @endif
                         
                    <div class="cart-item-details">
                        <h3 class="cart-item-title">{{ $item['product']->name }}</h3>
                        <p class="cart-item-price">{{ number_format($item['product']->price, 2) }} FCFA</p>
                        
                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST">
                            @csrf
                            <div class="quantity-selector">
                                <input type="number" 
                                       name="quantity" 
                                       class="quantity-input" 
                                       value="{{ $item['quantity'] }}" 
                                       min="1" 
                                       max="{{ $item['product']->stock }}">
                                <button type="submit" class="update-btn">Mettre à jour</button>
                            </div>
                        </form>
                        
                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" style="margin-top: 1rem;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Supprimer</button>
                        </form>
                    </div>
                    
                    <div>
                        <p style="font-weight: 600; font-size: 1.1rem;">
                            {{ number_format($item['total'], 2) }} FCFA
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="cart-summary">
            <h3 class="summary-title">Récapitulatif</h3>
            
            <div class="summary-row">
                <span>Sous-total</span>
                <span>{{ number_format($total, 2) }} FCFA</span>
            </div>
            
            <div class="summary-row">
                <span>Livraison</span>
                <span>À calculer</span>
            </div>
            
            <div class="summary-row summary-total">
                <span>Total</span>
                <span>{{ number_format($total, 2) }} FCFA</span>
            </div>
            
            <a href="{{ route('cart.checkout') }}" class="checkout-btn">
                Passer la commande
            </a>
        </div>
    @else
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <p class="empty-cart-text">Votre panier est vide</p>
            <a href="{{ route('products.index') }}" class="continue-shopping">
                Continuer vos achats
            </a>
        </div>
    @endif
</div>
@endsection