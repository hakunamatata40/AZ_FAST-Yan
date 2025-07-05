<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('AZ_fastlogo.png') }}" type="image/png">
    <title>@yield('title', 'EEUEZ Market')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        :root {
            --primary: #059669;
            --primary-dark: #047857;
            --secondary: #1e40af;
            --accent: #f59e0b;
            --text: #374151;
            --light: #f9fafb;
            --dark: #1f2937;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-bottom: 60px; /* Space for mobile navbar */
        }

        /* Mobile Bottom Navigation */
        .mobile-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 1000;
            display: none; /* Hidden by default, shown on mobile */
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text);
            font-size: 12px;
            transition: var(--transition);
        }

        .mobile-nav-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .mobile-nav-item.active {
            color: var(--primary);
        }

        .mobile-nav-item:hover {
            color: var(--primary);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 30px 0;
            margin-top: 40px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary);
        }

        .footer-section p, .footer-section a {
            margin-bottom: 10px;
            display: block;
            color: #d1d5db;
            transition: var(--transition);
        }

        .footer-section a:hover {
            color: white;
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mobile-nav {
                display: flex;
                align-items: center;
            }

            footer {
                padding-bottom: 70px; /* Account for mobile nav */
                /* height: 100px; */
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <main>
        @yield('content')
    </main>

    {{-- <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>EEUEZ Market</h3>
                <p>La meilleure plateforme d'achat et de vente en ligne.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Liens rapides</h3>
                <a href="/">Accueil</a>
                <a href="/products">Produits</a>
                <a href="/about">À propos</a>
                <a href="/contact">Contact</a>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p><i class="fas fa-envelope mr-2"></i> contact@eeuezmarket.com</p>
                <p><i class="fas fa-phone mr-2"></i> +237 657 757 036</p>
            </div>
        </div>
        <div class="copyright">
            ©2025 EEUEZ Market. Tous droits réservés.
        </div>
    </footer> --}}

    <!-- Mobile Bottom Navigation -->
<nav class="mobile-nav">
    <a href="{{ route('client.products.interests') }}" class="mobile-nav-item">
        <i class="fas fa-home"></i>
        <span>Pour vous</span>
    </a>
    <a href="{{ route('client.products.index') }}" class="mobile-nav-item">
        <i class="fas fa-shopping-bag"></i>
        <span>Boutique</span>
    </a>
    <a href="{{ route('cart.view') }}" class="mobile-nav-item">
        <i class="fas fa-shopping-cart"></i>
        <span id="cartCount">panier</span>
    </a>
            
    <div class="user-menu" onclick="location.href='{{ route('client.profile') }}'" style="border-radius: 50%; overflow: hidden; width: 40px; height: 40px; cursor: pointer;">
        @auth
            @if(auth()->user()->profileImage)
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" alt="Profile" class="profile-img">
            @else
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('jblogo.png') }}" alt="Profile" class="profile-img">
            @endif
        @else
            <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('jblogo.png') }}" alt="Profile" class="profile-img">
        @endauth
    </div>
</nav>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    @yield('scripts')
</body>
</html>