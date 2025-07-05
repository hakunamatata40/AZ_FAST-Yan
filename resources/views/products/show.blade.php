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
        --danger: #ef233c;
        --warning: #ff9e00;
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

    /* Container */
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Header */
    .dashboard-header {
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 768px) {
        .dashboard-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .logo-section {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .logo-section {
            margin-bottom: 0;
        }
    }

    .logo-img {
        height: 40px;
        width: auto;
        margin-right: 1rem;
    }

    .logo-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
    }

    .user-section {
        display: flex;
        align-items: center;
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 1rem;
    }

    .user-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin-right: 1.5rem;
    }

    .logout-btn {
        background: none;
        border: none;
        color: var(--danger);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        padding: 0.5rem;
        border-radius: 6px;
    }

    .logout-btn:hover {
        background-color: rgba(239, 35, 60, 0.1);
    }

    /* Wallet Card */
    .wallet-card {
        background: linear-gradient(135deg, var(--success), #2b9348);
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .wallet-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(56, 176, 0, 0.3);
    }

    .wallet-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .wallet-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .wallet-amount {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .wallet-btn {
        background: white;
        color: var(--success);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: var(--transition);
    }

    .wallet-btn:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
    }

    /* Product Section */
    .product-section {
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--dark);
        position: relative;
        padding-bottom: 0.75rem;
    }

    .product-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--primary), var(--accent));
        border-radius: 3px;
    }

    .product-meta {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .meta-item {
        background: var(--light);
        padding: 1rem;
        border-radius: 8px;
    }

    .meta-label {
        font-size: 0.875rem;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .meta-value {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .product-description {
        line-height: 1.7;
        margin: 2rem 0;
        color: var(--text);
    }

    /* Images Gallery */
    .gallery-section {
        margin: 2rem 0;
    }

    .gallery-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .gallery-item {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        aspect-ratio: 1/1;
        background: var(--light-gray);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .gallery-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        padding: 1rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
    }

    .btn-edit {
        background: var(--warning);
        color: white;
    }

    .btn-edit:hover {
        background: #e69100;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: var(--danger);
        color: white;
    }

    .btn-delete:hover {
        background: #d90429;
        transform: translateY(-2px);
    }

    /* Guest Message */
    .guest-message {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    .guest-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .guest-text {
        font-size: 1.1rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .user-section {
            width: 100%;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    @if (auth()->check())
        <!-- Header -->
        <header class="dashboard-header">
            <div class="logo-section">
                <a href="/client/dashboard">
                    <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo-img">
                </a>
                <span class="logo-title">Merchant Dashboard</span>
            </div>

            <div class="user-section">
                @if (auth()->user()->profileImage)
                    <img src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" 
                         alt="Profile Image" 
                         class="profile-img">
                @else
                    <img src="{{ asset('jblogo.png') }}" 
                         alt="Default Profile Image" 
                         class="profile-img">
                @endif

                <span class="user-name">{{ auth()->user()->name }}!</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Déconnexion
                    </button>
                </form>
            </div>
        </header>

        <!-- Wallet Card -->
        <div class="wallet-card">
            <h2 class="wallet-title">Solde du portefeuille</h2>
            <p class="wallet-amount">{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</p>
            <a href="{{ route('wallet.transaction.form') }}" class="wallet-btn">
                <i class="fas fa-wallet"></i> Gérer mon portefeuille
            </a>
        </div>

        <!-- Product Section -->
        <section class="product-section">
            <h1 class="product-title">{{ $product->name }}</h1>

            <div class="product-meta">
                <div class="meta-item">
                    <span class="meta-label">Catégorie</span>
                    <span class="meta-value">{{ $product->category->name }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Prix</span>
                    <span class="meta-value">{{ $product->price }} FCFA</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Stock</span>
                    <span class="meta-value">{{ $product->stock }}</span>
                </div>
            </div>

            <p class="product-description">
                {{ $product->description }}
            </p>

            <!-- Images Gallery -->
            <div class="gallery-section">
                <h3 class="gallery-title">Images du produit</h3>
                @if($product->images->count())
                    <div class="gallery-grid">
                        @foreach($product->images as $image)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="gallery-img">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Aucune image disponible pour ce produit.</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </section>
    @else
        <!-- Guest Message -->
        <div class="guest-message">
            <h1 class="guest-title">Bienvenue, invité!</h1>
            <p class="guest-text">Veuillez vous connecter pour accéder à votre tableau de bord.</p>
        </div>
    @endif
</div>
@endsection