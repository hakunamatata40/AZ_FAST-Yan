@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - AZ</title>
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

        /* Profile Form */
        .profile-form {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            animation: fadeIn 0.8s ease 0.4s both;
        }

        .form-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray-light);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
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

            .form-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if (auth()->check())
            <!-- Header -->
            <header class="header">
                <div class="logo">
                    <a href="/client/dashboard">
                        <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo">
                    </a>
                </div>

                <div class="user-info">
                    @if (auth()->user()->profileImage)
                        <img src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" alt="Profile Image" class="profile-pic">
                    @else
                        <img src="{{ asset('jblogo.png') }}" alt="Default Profile Image" class="profile-pic">
                        <a href="{{ route('profile.edit') }}" class="add-profile-link">Add profile</a>
                    @endif

                    <div>
                        <h1 class="user-name">{{ auth()->user()->name }}!</h1>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Déconnexion</button>
                    </form>
                </div>
            </header>

            <!-- Wallet Card -->
            <div class="wallet-card pulse">
                <h2 class="wallet-title"><i class="fas fa-wallet"></i> Montant du portefeuille</h2>
                <p class="wallet-amount">{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</p>
                <a href="{{ route('wallet.transaction.form') }}" class="wallet-btn">
                    <i class="fas fa-cog"></i> Gérer mon portefeuille
                </a>
            </div>

            <!-- Upgrade Button -->
            <form method="GET" action="{{ route('client.upgrade.form') }}">
                <button type="submit" class="upgrade-btn">
                    <i class="fas fa-star"></i> Devenir Merchant Client
                </button>
            </form>

            <!-- Profile Form -->
            <div class="profile-form">
                <h2 class="form-title"><i class="fas fa-user-circle"></i> Mon Profil</h2>

                <form method="POST" action="{{ route('client.profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Nom Complet</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Numéro de Téléphone</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" required class="form-input">
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i> Mettre à Jour
                    </button>
                </form>
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