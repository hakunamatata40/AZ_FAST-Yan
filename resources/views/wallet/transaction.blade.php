<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portefeuille - Transactions</title>
    <style>
        /* Reset et Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            from { transform: translateX(50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            animation: fadeIn 0.8s ease-out;
        }

        .logo-container {
            display: flex;
            align-items: center;
            animation: slideInLeft 0.8s ease-out;
        }

        .logo-container img {
            height: 50px;
            width: auto;
            margin-right: 1rem;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: rotate(-5deg) scale(1.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            animation: slideInRight 0.8s ease-out;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
        }

        .user-name {
            margin-left: 1rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .logout-btn {
            margin-left: 1.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .logout-btn i {
            margin-right: 0.5rem;
        }

        /* Contenu Principal */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 1s ease-out;
        }

        h1 {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            color: #2d3748;
            position: relative;
            padding-bottom: 0.5rem;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .balance {
            font-size: 1.4rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
            border-radius: 10px;
            border-left: 5px solid #667eea;
            animation: pulse 2s infinite;
        }

        .balance span {
            font-size: 1.6rem;
            color: #4a5568;
            font-weight: 700;
        }

        /* Formulaires */
        .form-container {
            margin-bottom: 2rem;
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            animation: fadeIn 1.2s ease-out;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #4a5568;
            display: flex;
            align-items: center;
        }

        .form-container h2 i {
            margin-right: 0.8rem;
            color: #667eea;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }

        select, input {
            width: 100%;
            padding: 0.8rem 1rem;
            margin-bottom: 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        select:focus, input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        button[type="submit"] {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .deposit-btn {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .deposit-btn:hover {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 161, 105, 0.3);
        }

        .withdraw-btn {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .withdraw-btn:hover {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 62, 62, 0.3);
        }

        /* Messages */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1.5rem;
            font-weight: 500;
            animation: fadeIn 0.5s ease-out;
        }

        .alert-success {
            background-color: #f0fff4;
            color: #2f855a;
            border-left: 4px solid #48bb78;
        }

        .alert-error {
            background-color: #fff5f5;
            color: #c53030;
            border-left: 4px solid #f56565;
        }

        /* Icônes */
        .icon {
            margin-right: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
            }

            .user-info {
                margin-top: 1rem;
                flex-direction: column;
            }

            .user-name {
                margin: 0.5rem 0;
            }

            .logout-btn {
                margin: 0.5rem 0 0 0;
            }

            .container {
                padding: 1.5rem;
            }
        }
    </style>
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow mb-6">
        <!-- AZ Logo on the Left -->
        <div class="logo-container" style="position: absolute; left: 20px;">
            <a href="/client/dashboard"> 
                <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="h-10 w-auto mr-4">
            </a>
        </div>

        <!-- User Info and Logout on the Right -->
        <div class="user-info" onclick="location.href='{{ route('profile.edit') }}'">
            <!-- Display Profile Picture -->
            @if (auth()->user()->profileImage)
                <img src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" alt="Profile Image" class="profile-image">
            @else
                <img src="{{ asset('jblogo.png') }}" alt="Default Profile Image" class="profile-image">
                
            @endif

            <div class="user-name">{{ auth()->user()->name }}!</div>

        </div>
    </header>

    <div class="container">
        <h1>Votre portefeuille</h1>

        <div class="balance">
            Solde actuel: <span>{{ number_format($wallet->balance, 2) }} FCFA</span>
        </div>

        <!-- Deposit Form -->
        <form action="{{ route('wallet.deposit') }}" method="POST" class="form-container">
            @csrf
            <h2><i class="fas fa-money-bill-wave"></i> Déposer des fonds</h2>

            <label for="transaction_type">Choisir le type de transaction:</label>
            <select name="transaction_type" required>
                <option value="MTN">MTN MoMo</option>
                <option value="Orange">Orange Money</option>
            </select>

            <label for="phone_number">Numéro de téléphone (MTN ou Orange):</label>
            <input type="text" name="phone_number" required placeholder="Numéro de transaction">

            <label for="amount">Montant à déposer:</label>
            <input type="number" name="amount" step="0.01" required>

            <button type="submit" class="deposit-btn">
                <i class="fas fa-plus-circle icon"></i> Déposer
            </button>
        </form>

        <!-- Withdraw Form -->
        <form action="{{ route('wallet.withdraw') }}" method="POST" class="form-container">
            @csrf
            <h2><i class="fas fa-hand-holding-usd"></i> Retirer des fonds</h2>

            <label for="transaction_type">Choisir le type de transaction:</label>
            <select name="transaction_type" required>
                <option value="MTN">MTN MoMo</option>
                <option value="Orange">Orange Money</option>
            </select>

            <label for="phone_number">Numéro de téléphone (MTN ou Orange):</label>
            <input type="text" name="phone_number" required placeholder="Numéro de transaction">

            <label for="amount">Montant à retirer:</label>
            <input type="number" name="amount" step="0.01" required>

            <button type="submit" class="withdraw-btn">
                <i class="fas fa-minus-circle icon"></i> Retirer
            </button>
        </form>

        <!-- Display Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif
    </div>

    <script>
        // Animation supplémentaire au chargement
        document.addEventListener('DOMContentLoaded', () => {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach((form, index) => {
                form.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>
</body>
</html>