@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - AZ</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --orange: #ff7b00;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --green: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
            margin-bottom: 30px;
            color: white;
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.8s ease;
        }

        .header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }

        .logo img {
            height: 40px;
            transition: transform 0.3s ease;
        }

        .logo:hover img {
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-pic {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-pic:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .user-name {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .logout-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            margin-left: 15px;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        .add-profile-link {
            color: white;
            font-size: 0.8rem;
            margin-left: 5px;
            text-decoration: underline;
        }

        /* Wallet Card */
        .wallet-card {
            background: linear-gradient(135deg, var(--green) 0%, #27ae60 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2);
            transition: all 0.3s ease;
            animation: fadeIn 0.8s ease 0.2s both;
            position: relative;
            overflow: hidden;
        }

        .wallet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(46, 204, 113, 0.3);
        }

        .wallet-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 L0,100 Z"></path></svg>');
            background-size: cover;
        }

        .wallet-title {
            font-size: 1.2rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .wallet-amount {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .wallet-btn {
            background: white;
            color: var(--green);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 10px;
        }

        .wallet-btn:hover {
            background: rgba(255,255,255,0.9);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Upgrade Button */
        .upgrade-btn {
            background: linear-gradient(135deg, var(--orange) 0%, #ff5500 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(255, 123, 0, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .upgrade-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 123, 0, 0.4);
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid var(--gray-light);
            animation: fadeIn 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: rgba(67, 97, 238, 0.2);
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .card-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            font-size: 1.5rem;
        }

        .card-description {
            color: var(--gray);
            margin-bottom: 20px;
        }

        .card-link {
            color: var(--primary);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .card-link:hover {
            color: var(--secondary);
            transform: translateX(5px);
        }

        /* Guest Message */
        .guest-message {
            text-align: center;
            padding: 40px 20px;
            animation: fadeIn 0.8s ease;
        }

        .guest-message h1 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .guest-message p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: var(--gray);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .user-info {
                flex-direction: column;
            }

            .logout-btn {
                margin-left: 0;
                margin-top: 10px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if (auth()->check())
            <!-- Header -->
            <header class="header">
                <div class="logo" style="position: absolute; left: 20px;">
                    <a href="/client/dashboard" >
                        <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo">
                    </a>
                </div>

                
            </header>

            <!-- Wallet Card -->
            <div class="wallet-card pulse" onclick="location.href='{{ route('wallet.transaction.form') }}'">
                <h2 class="wallet-title"><i class="fas fa-wallet"></i> Montant du portefeuille</h2>
                <p class="wallet-amount">{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</p>
            </div>

            <!-- Upgrade Button -->
            <form method="GET" action="{{ route('client.upgrade.form') }}">
                <button type="submit" class="upgrade-btn">
                    <i class="fas fa-star"></i> Devenir Merchant Client
                </button>
            </form>

            <!-- Dashboard Cards -->
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-box-open"></i> Vos Commandes</h2>
                    <p class="card-description">Gérez toutes vos commandes en cours et passées.</p>
                    <a href="{{ route('client.orders.index') }}" class="card-link">
                        Voir les Commandes <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-shopping-bag"></i> Produits</h2>
                    <p class="card-description">Découvrez tous les produits disponibles.</p>
                    <a href="{{ route('client.products.index') }}" class="card-link">
                        Voir les Produits <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-user"></i> Profil</h2>
                    <p class="card-description">Modifiez vos informations personnelles.</p>
                    <a href="{{ route('client.profile') }}" class="card-link">
                        Voir le Profil <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="dashboard-card">
                    <h2 class="card-title"><i class="fas fa-headset"></i> Support</h2>
                    <p class="card-description">Contactez notre équipe d'assistance.</p>
                    <a href="{{ route('client.support') }}" class="card-link">
                        Contacter le Support <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @else
            <!-- Guest Message -->
            <div class="guest-message">
                <h1>Bienvenue, invité!</h1>
                <p>Veuillez vous connecter pour accéder à votre tableau de bord.</p>
            </div>
        @endif
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Custom JS for animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to cards when they come into view
            const animateCards = () => {
                const cards = document.querySelectorAll('.dashboard-card');
                const windowHeight = window.innerHeight;
                
                cards.forEach((card, index) => {
                    const cardPosition = card.getBoundingClientRect().top;
                    
                    if (cardPosition < windowHeight - 100) {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }
                });
            };
            
            // Set initial state for animation
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = `all 0.5s ease ${index * 0.1}s`;
            });
            
            // Run once on load
            animateCards();
            
            // Run on scroll
            window.addEventListener('scroll', animateCards);
            
            // Add pulse animation to wallet amount
            const walletAmount = document.querySelector('.wallet-amount');
            if (walletAmount) {
                setInterval(() => {
                    walletAmount.classList.toggle('pulse');
                }, 4000);
            }
        });
    </script>
</body>
</html>
@endsection