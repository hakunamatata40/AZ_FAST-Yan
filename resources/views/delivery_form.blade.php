<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Livraison</title>
    <link rel="icon" href="{{ asset('AZ_fastlogo.png') }}" type="image/png">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            padding: 20px;
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

        /* Wallet Card */
        .wallet-card {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            color: white;
            animation: fadeIn 1s ease-out;
            transition: all 0.3s ease;
        }

        .wallet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .wallet-card h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .wallet-card p {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .wallet-btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: white;
            color: #38a169;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .wallet-btn:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }

        /* Form Header */
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.5rem;
            color: white;
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Form Content */
        .form-content {
            padding: 2rem;
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        /* Product Card */
        .product-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }

        .product-card p {
            font-size: 1.1rem;
            font-weight: 700;
            color: #4a5568;
        }

        /* Payment Section */
        .payment-section {
            margin-top: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.8rem;
            border-radius: 8px;
            background: white;
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .payment-option input {
            margin-right: 1rem;
        }

        /* Total Price */
        .total-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin: 1.5rem 0;
            padding: 1rem;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
            border-radius: 10px;
            border-left: 5px solid #667eea;
            animation: pulse 2s infinite;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66, 153, 225, 0.3);
        }

        .submit-btn i {
            margin-right: 0.8rem;
        }

        /* Coordinates */
        .coordinates {
            font-size: 0.9rem;
            color: #718096;
            margin-top: 0.5rem;
        }

        /* Error Messages */
        .error-messages {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #fff5f5;
            border-left: 4px solid #f56565;
            border-radius: 8px;
            color: #c53030;
        }

        .error-messages ul {
            list-style: none;
        }

        .error-messages li {
            margin-bottom: 0.5rem;
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

            .form-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    @if (auth()->check())
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

    <!-- Wallet Information Card -->
    <div class="wallet-card">
        <h2><i class="fas fa-wallet"></i> Solde du Portefeuille</h2>
        <p>{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</p>
        <a href="{{ route('wallet.transaction.form') }}" class="wallet-btn">
            <i class="fas fa-cog"></i> Gérer mon portefeuille
        </a>
    </div>
        
    @else
        <h1 class="text-3xl font-bold mb-4">Bienvenue, invité!</h1>
        <p class="mb-4">Veuillez vous connecter pour accéder à votre tableau de bord.</p>
    @endif

    <div class="main-container">
        <div class="form-header">
            <h1><i class="fas fa-truck"></i> Formulaire de Livraison</h1>
        </div>

        <div class="form-content">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf 

                <div class="form-grid">
                    <!-- Sender Fields -->
                    <div class="form-group">
                        <label>Nom complet de l'expéditeur</label>
                        <input type="text" name="sender_name" placeholder="ex: EYOUM ATOCK J-J Bryan" required>
                    </div>
                    <div class="form-group">
                        <label>Numéro de téléphone de l'expéditeur</label>
                        <input type="text" name="sender_phone" placeholder="+237" required>
                    </div>
                    <div class="form-group">
                        <label>Pays de l'expéditeur</label>
                        <select id="sender-country" name="sender_country" required>
                            <option value="">Sélectionnez un pays</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country}}">{{ $country}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ville de l'expéditeur</label>
                        <select id="sender-town" name="sender_town" required>
                            <option value="">Sélectionnez une ville</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quartier de l'expéditeur</label>
                        <select id="sender-quarter" name="sender_quarter" required>
                            <option value="">Sélectionnez un quartier</option>
                        </select>
                        <div class="coordinates">
                            Latitude: <span id="sender-lat">N/A</span> | 
                            Longitude: <span id="sender-lng">N/A</span>
                        </div>
                    </div>

                    <!-- Receiver Fields -->
                    <div class="form-group">
                        <label>Nom du destinataire</label>
                        <input type="text" name="receiver_name" placeholder="ex: Isaac Louis Vuiton" required>
                    </div>
                    <div class="form-group">
                        <label>Numéro de téléphone du destinataire</label>
                        <input type="text" name="receiver_phone" placeholder="+237" required>
                    </div>
                    <div class="form-group">
                        <label>Pays du destinataire</label>
                        <select id="receiver-country" name="receiver_country" required>
                            <option value="">Sélectionnez un pays</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country}}">{{ $country}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ville du destinataire</label>
                        <select id="receiver-town" name="receiver_town" required>
                            <option value="">Sélectionnez une ville</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quartier du destinataire</label>
                        <select id="receiver-quarter" name="receiver_quarter" required>
                            <option value="">Sélectionnez un quartier</option>
                        </select>
                        <div class="coordinates">
                            Latitude: <span id="receiver-lat">N/A</span> | 
                            Longitude: <span id="receiver-lng">N/A</span>
                        </div>
                    </div>

                    <!-- Product Information -->
                    <div class="product-card">
                        <h3><i class="fas fa-box"></i> Informations sur le produit</h3>
                        <h4>{{ $product->name }}</h4>
                        <p>Prix: {{ $product->price }} FCFA</p>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                        <input type="hidden" name="merchant_id" value="{{ $product->merchant_id }}">
                        <input type="hidden" name="category_id" value="{{ $product->category_id }}">
                    </div>

                    <!-- Total Price -->
                    <div class="total-price">
                        <i class="fas fa-receipt"></i> Prix total: <span id="total_price">0 FCFA</span>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="payment-section">
                    <h3><i class="fas fa-credit-card"></i> Informations de paiement</h3>
                    
                    <div class="form-group">
                        <label>Numéro de paiement</label>
                        <input type="text" name="payment_number" placeholder="Entrez votre numéro de paiement" required>
                    </div>

                    <div class="payment-option">
                        <input type="radio" name="payment" value="mtn" id="mtn" required>
                        <label for="mtn">MTN MOBILE MONEY</label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" value="orange" id="orange" required>
                        <label for="orange">ORANGE MONEY</label>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Confirmer la livraison
                </button>

                @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>
    </div>

    <script>
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the Earth in km
        const dLat = (lat2 - lat1) * (Math.PI / 180);
        const dLon = (lon2 - lon1) * (Math.PI / 180);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
                  Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Distance in km
    }

    // Calculate the total price based on distance and product price
    function calculateTotalPrice() {
        const productPrice = parseFloat($('input[name="product_price"]').val());
        const senderLat = parseFloat($('#sender-lat').text());
        const senderLng = parseFloat($('#sender-lng').text());
        const receiverLat = parseFloat($('#receiver-lat').text());
        const receiverLng = parseFloat($('#receiver-lng').text());

        if (!isNaN(senderLat) && !isNaN(senderLng) && !isNaN(receiverLat) && !isNaN(receiverLng)) {
            const distance = calculateDistance(senderLat, senderLng, receiverLat, receiverLng);
            const deliveryCost = Math.ceil(distance) * 450; // 750 FCFA per km
            const totalPrice = productPrice + deliveryCost;

            $('#total_price').text(totalPrice + ' FCFA');
        } else {
            $('#total_price').text('N/A');
        }
    }

    // Event listeners to calculate total price when inputs change
    $('#sender-lat, #sender-lng, #receiver-lat, #receiver-lng').on('input', calculateTotalPrice);
    $('input[name="product_price"]').on('change', calculateTotalPrice);

    // Fetch towns when a sender country is selected
    $('#sender-country').on('change', function() {
        var senderCountry = $(this).val();
        $.ajax({
            url: '/get-towns/' + senderCountry,
            type: 'GET',
            success: function(response) {
                var senderTownSelect = $('#sender-town');
                senderTownSelect.empty();
                senderTownSelect.append('<option value="">Select Town</option>');

                $.each(response.towns, function(index, town) {
                    senderTownSelect.append('<option value="' + town + '">' + town + '</option>');
                });
            }
        });
    });

    // Fetch quarters when a sender town is selected
    $('#sender-town').on('change', function() {
        var senderTown = $(this).val();
        $.ajax({
            url: '/get-quarters/' + senderTown,
            type: 'GET',
            success: function(response) {
                var senderQuarterSelect = $('#sender-quarter');
                senderQuarterSelect.empty();
                senderQuarterSelect.append('<option value="">Select Quarter</option>');

                $.each(response.quarters, function(index, quarter) {
                    senderQuarterSelect.append('<option value="' + quarter.quarter + '" data-latitude="' + quarter.latitude + '" data-longitude="' + quarter.longitude + '">' + quarter.quarter + '</option>');
                });
            }
        });
    });

    // Update sender latitude and longitude when the sender quarter is selected
    $('#sender-quarter').on('change', function() {
        const selectedOption = $(this).find(':selected');
        const latitude = selectedOption.data('latitude');
        const longitude = selectedOption.data('longitude');

        if (latitude && longitude) {
            $('#sender-lat').text(latitude);
            $('#sender-lng').text(longitude);
            calculateTotalPrice();
        } else {
            $('#sender-lat').text('N/A');
            $('#sender-lng').text('N/A');
            $('#total_price').text('N/A');
        }
    });

    // Fetch towns when a receiver country is selected
    $('#receiver-country').on('change', function() {
        var receiverCountry = $(this).val();
        $.ajax({
            url: '/get-towns/' + receiverCountry,
            type: 'GET',
            success: function(response) {
                var receiverTownSelect = $('#receiver-town');
                receiverTownSelect.empty();
                receiverTownSelect.append('<option value="">Select Town</option>');

                $.each(response.towns, function(index, town) {
                    receiverTownSelect.append('<option value="' + town + '">' + town + '</option>');
                });
            }
        });
    });

    // Fetch quarters when a receiver town is selected
    $('#receiver-town').on('change', function() {
        var receiverTown = $(this).val();
        $.ajax({
            url: '/get-quarters/' + receiverTown,
            type: 'GET',
            success: function(response) {
                var receiverQuarterSelect = $('#receiver-quarter');
                receiverQuarterSelect.empty().append('<option value="">Select Quarter</option>');

                $.each(response.quarters, function(index, quarter) {
                    receiverQuarterSelect.append('<option value="' + quarter.quarter + '" data-latitude="' + quarter.latitude + '" data-longitude="' + quarter.longitude + '">' + quarter.quarter + '</option>');
                });
            },
            error: function() {
                console.error('Error fetching quarters.');
            }
        });
    });

    // Update receiver latitude and longitude when the receiver quarter is selected
    $('#receiver-quarter').on('change', function() {
        const selectedOption = $(this).find(':selected');
        const latitude = selectedOption.data('latitude');
        const longitude = selectedOption.data('longitude');

        if (latitude && longitude) {
            $('#receiver-lat').text(latitude);
            $('#receiver-lng').text(longitude);
            calculateTotalPrice();
        } else {
            $('#receiver-lat').text('N/A');
            $('#receiver-lng').text('N/A');
            $('#total_price').text('N/A');
        }
    });
    </script>
</body>
</html>