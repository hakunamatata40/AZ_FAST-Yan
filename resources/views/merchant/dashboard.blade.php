@extends('layout.app')

@section('content')
<style>
    body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 100%;
    padding: 20px;
    margin: 0 auto;
}

h1 {
    font-size: 2rem;
    color: #333;
    text-align: center;
    margin-bottom: 1.5rem;
    animation: fadeIn 1s ease-in;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #ffffff, #e5e7eb);
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo {
    height: 40px;
    transition: transform 0.3s ease;
}

.logo:hover {
    transform: scale(1.1);
}

.header-right {
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
    transition: border-color 0.3s ease;
}

.profile-img:hover {
    border-color: #10b981;
}

.profile-link {
    color: #2563eb;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.profile-link:hover {
    color: #1e40af;
}

.user-info h2 {
    font-size: 1.5rem;
    color: #333;
}

.logout-btn {
    background: none;
    border: none;
    color: #ef4444;
    font-size: 0.9rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

.logout-btn:hover {
    color: #b91c1c;
}

.card {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.5s ease forwards;
}

.card.wallet-card {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card.wallet-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.card h2 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.card p {
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.btn {
    display: inline-block;
    background: #fff;
    color: #059669;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background: #f3f4f6;
    color: #047857;
    transform: translateY(-2px);
}

.grid {
    display: grid;
    gap: 1rem;
}

.grid-item {
    background: #f9fafb;
    padding: 15px;
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.grid-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.grid-item h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.grid-item p {
    font-size: 0.9rem;
    color: #6b7280;
    margin-bottom: 0.5rem;
}

.link {
    color: #2563eb;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.link:hover {
    color: #1e40af;
    text-decoration: underline;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Design */
@media (min-width: 768px) {
    .container {
        max-width: 1200px;
    }

    h1 {
        font-size: 2.5rem;
    }

    .grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .header {
        padding: 20px;
    }

    .card h2 {
        font-size: 1.8rem;
    }

    .card p {
        font-size: 1.3rem;
    }
}
</style>
<div class="container">
    <div class="header-left">
                <a href="/client/dashboard">
                    <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo">
                </a>
            </div>
        <h1>Tableau de Bord du Merchant</h1>
        @if (auth()->check())
        

        <!-- Wallet Card -->
        <div class="card wallet-card">
            <h2>Portefeuille</h2>
            <p><b>{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</b></p>
            <a href="{{ route('wallet.transaction.form') }}" class="btn">Gérer mon portefeuille</a>
        </div>

        <!-- Products Section -->
        <div class="card products-card">
            <h2>Gérer Vos Produits</h2>
            <div class="grid">
                <div class="grid-item" onclick="location.href='{{ route('merchant.storefront.create') }}'">
                    <h3>Ajouter une Vitrine</h3>
                    <p>Créez une nouvelle vitrine pour afficher vos produits.</p>
                </div>
                <div class="grid-item" onclick="location.href='{{ route('merchant.storefronts') }}'">
                    <h3>Voir les Vitrines</h3>
                    <p>Gérez et modifiez vos vitrines existantes.</p>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="card orders-card">
            <h2>Gérer les Commandes</h2>
            <div class="grid-item" onclick="location.href='{{ route('merchant.orders.index') }}'">
                <h3>Voir les Commandes</h3>
                <p>Consultez et gérez toutes vos commandes entrantes.</p>
            </div>
        </div>
        @else
        <h1>Bienvenue, invité!</h1>
        <p>Veuillez vous connecter pour accéder à votre tableau de bord.</p>
        @endif
    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Animation des cartes au chargement
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
    });

    // Animation au survol des boutons
    const buttons = document.querySelectorAll('.btn, .link, .logout-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'scale(1.05)';
        });
        button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection
