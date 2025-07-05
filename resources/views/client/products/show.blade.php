@extends('layout.app')

@section('styles')
<style>
    /* Variables CSS */
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #f72585;
        --accent: #4cc9f0;
        --success: #38b000;
        --text: #2b2d42;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #e9ecef;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    /* Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7fa;
        color: var(--text);
    }

    /* Product Container */
    .product-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    /* Back Button */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        padding: 0.5rem 1rem;
        border-radius: 50px;
    }

    .back-btn:hover {
        background-color: rgba(67, 97, 238, 0.1);
        transform: translateX(-5px);
    }

    /* Product Layout */
    .product-layout {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    @media (min-width: 992px) {
        .product-layout {
            flex-direction: row;
        }
    }

    /* Gallery Section */
    .gallery-section {
        flex: 1;
        padding: 1.5rem;
    }

    .main-image-container {
        position: relative;
        margin-bottom: 1rem;
        border-radius: 8px;
        overflow: hidden;
        background-color: var(--light-gray);
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image {
        max-width: 100%;
        max-height: 500px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .main-image:hover {
        transform: scale(1.03);
    }

    .thumbnail-container {
        display: flex;
        gap: 0.75rem;
        padding: 0.5rem 0;
        overflow-x: auto;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition);
    }

    .thumbnail:hover {
        border-color: var(--primary);
        transform: translateY(-3px);
    }

    .thumbnail.active {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    /* Details Section */
    .details-section {
        flex: 1;
        padding: 2rem;
        position: relative;
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--dark);
        line-height: 1.2;
    }

    .product-price-container {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .current-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary);
    }

    .original-price {
        font-size: 1.25rem;
        color: var(--gray);
        text-decoration: line-through;
    }

    .discount-badge {
        background-color: var(--secondary);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .rating-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .stars {
        color: #ffc107;
        font-size: 1.1rem;
    }

    .rating-count {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .product-description {
        line-height: 1.7;
        margin-bottom: 2rem;
        color: var(--text);
    }

    /* Quantity Selector */
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--light);
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .quantity-btn:hover {
        background: var(--primary);
        color: white;
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 600;
        border: 1px solid var(--light-gray);
        border-radius: 6px;
        padding: 0.5rem;
    }

    /* Meta Info */
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .meta-item {
        background-color: var(--light);
        padding: 1rem;
        border-radius: 8px;
    }

    .meta-label {
        font-size: 0.875rem;
        color: var(--gray);
        margin-bottom: 0.25rem;
    }

    .meta-value {
        font-weight: 600;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.875rem 1.75rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        border: none;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
    }

    .btn-secondary {
        background-color: white;
        color: var(--primary);
        border: 1px solid var(--primary);
    }

    .btn-secondary:hover {
        background-color: rgba(67, 97, 238, 0.05);
        transform: translateY(-2px);
    }

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #2d9e00;
        transform: translateY(-2px);
    }

    /* Cart Notification */
    .cart-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--success);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 1000;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .cart-notification.show {
        opacity: 1;
        transform: translateY(0);
    }

    /* Related Products */
    .related-products {
        margin-top: 4rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--primary), var(--accent));
        border-radius: 3px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--secondary);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 1;
    }

    .product-image-container {
        position: relative;
        background-color: var(--light-gray);
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image {
        max-width: 100%;
        max-height: 250px;
        object-fit: contain;
        padding: 1rem;
    }

    .product-card-body {
        padding: 1.25rem;
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .product-card-price {
        font-weight: 700;
        color: var(--primary);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .product-title {
            font-size: 1.5rem;
        }
        
        .current-price {
            font-size: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .product-layout {
        animation: fadeIn 0.6s ease-out;
    }
</style>
@endsection

@section('content')
<div class="product-container">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Retour aux produits
    </a>

    <div class="product-layout">
        <!-- Gallery Section -->
        <div class="gallery-section">
            <!-- Main Image -->
            <div class="main-image-container">
                @if($product->images->count())
                    <img id="mainImage" src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                         alt="{{ $product->name }}" 
                         class="main-image">
                @else
                    <i class="fas fa-image" style="font-size: 3rem; color: #adb5bd;"></i>
                @endif
            </div>

            <!-- Thumbnails -->
            @if($product->images->count() > 1)
                <div class="thumbnail-container">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $product->name }}" 
                             class="thumbnail {{ $loop->first ? 'active' : '' }}"
                             onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Details Section -->
        <div class="details-section">
            <h1 class="product-title">{{ $product->name }}</h1>
            
            <div class="product-price-container">
                <span class="current-price">{{ number_format($product->price, 2) }} FCFA</span>
                @if($product->discount > 0)
                    <span class="original-price">{{ number_format($product->price * (1 + $product->discount/100), 2) }} FCFA</span>
                    <span class="discount-badge">-{{ $product->discount }}%</span>
                @endif
            </div>

            <div class="rating-container">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <span class="rating-count">(128 avis)</span>
            </div>

            <p class="product-description">
                {{ $product->description }}
            </p>

            <!-- Quantity Selector -->
            <div class="quantity-selector">
                <button class="quantity-btn" onclick="updateQuantity(-1)">-</button>
                <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="99">
                <button class="quantity-btn" onclick="updateQuantity(1)">+</button>
            </div>

            <div class="meta-grid">
                <div class="meta-item">
                    <span class="meta-label">Catégorie</span>
                    <span class="meta-value">{{ $product->category->name ?? 'Non spécifiée' }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Disponibilité</span>
                    <span class="meta-value">{{ $product->stock > 0 ? 'En stock' : 'Rupture' }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Vendeur</span>
                    <span class="meta-value">{{ $product->merchant->business_name ?? $product->user->name }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Livraison</span>
                    <span class="meta-value">24-48h</span>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn btn-primary" onclick="addToCart()">
                    <i class="fas fa-cart-plus"></i> Ajouter au panier
                </button>
                <button class="btn btn-secondary">
                    <i class="far fa-heart"></i> Favoris
                </button>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="related-products">
            <h2 class="section-title">Produits similaires</h2>
            <div class="products-grid">
                @foreach($relatedProducts as $related)
                    <div class="product-card" onclick="location.href='{{ route('products.show', $related->id) }}'">
                        @if($related->discount > 0)
                            <span class="product-badge">-{{ $related->discount }}%</span>
                        @endif
                        
                        <div class="product-image-container">
                            @if($related->images->count())
                                <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" 
                                     alt="{{ $related->name }}" 
                                     class="product-image">
                            @else
                                <i class="fas fa-image" style="font-size: 2rem; color: #adb5bd;"></i>
                            @endif
                        </div>

                        <div class="product-card-body">
                            <h3 class="product-name">{{ $related->name }}</h3>
                            <p class="product-card-price">{{ number_format($related->price, 2) }} FCFA</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Cart Notification -->
<div id="cartNotification" class="cart-notification">
    <i class="fas fa-check-circle"></i>
    <span>Produit ajouté au panier!</span>
</div>
@endsection

@section('scripts')
<script>
    function changeMainImage(src, element) {
        document.getElementById('mainImage').src = src;
        
        // Remove active class from all thumbnails
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        
        // Add active class to clicked thumbnail
        element.classList.add('active');
    }

    // Quantity management
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        let newValue = parseInt(input.value) + change;
        
        if (newValue < 1) newValue = 1;
        if (newValue > 99) newValue = 99;
        
        input.value = newValue;
    }

    // Add to cart function
    function addToCart() {
        const quantity = document.getElementById('quantity').value;
        const productId = {{ $product->id }};
        
        // AJAX request to add to cart
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show notification
                const notification = document.getElementById('cartNotification');
                notification.classList.add('show');
                
                // Hide after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
                
                // Update cart count in navbar if exists
                if (document.getElementById('cartCount')) {
                    document.getElementById('cartCount').textContent = data.cartCount;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Prevent quantity input from going out of bounds
    document.getElementById('quantity').addEventListener('change', function() {
        if (this.value < 1) this.value = 1;
        if (this.value > 99) this.value = 99;
    });
</script>
@endsection