<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('AZ_fastlogo.png') }}" type="image/png">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <style>
        :root {
            --primary: #059669; /* emerald-600 */
            --primary-dark: #047857; /* emerald-700 */
            --secondary: #1e40af; /* blue-900 */
            --text: #374151;
            --light: #f9fafb;
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
            background: linear-gradient(135deg, var(--secondary) 0%, #2c5282 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            animation: gradientBG 15s ease infinite;
            background-size: 400% 400%;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(0);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            animation: borderAnimation 3s linear infinite;
        }

        @keyframes borderAnimation {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
        }

        .card-header img {
            height: 50px;
            margin-right: 15px;
            transition: var(--transition);
        }

        .card-header:hover img {
            transform: rotate(10deg);
        }

        .card-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--secondary);
            position: relative;
        }

        .card-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 16px;
            transition: var(--transition);
            background-color: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);
            background-color: white;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(30deg);
            transition: var(--transition);
        }

        .btn:hover::after {
            left: 100%;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #6b7280;
            font-size: 15px;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
        }

        .register-link a:hover::after {
            width: 100%;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
            
            .card-title {
                font-size: 24px;
            }
        }
    </style>

    <div class="login-card">
        <!-- Card Header -->
        <div class="card-header">
            <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo">
            <h1 class="card-title">Login</h1>
        </div>

        <!-- Login Form -->
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            
            <!-- Hidden Fields for Geolocation -->
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="address_name" id="address_name">

            <!-- Submit Button -->
            <button type="submit" class="btn">Login</button>
        </form>

        <!-- Register Link -->
        <p class="register-link">
            Register as a client: <a href="{{ route('client.register.form') }}">Register</a>
        </p>
    </div>

    <!-- Geolocation Script -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const longitude = position.coords.longitude;
                    const latitude = position.coords.latitude;

                    // Set the hidden fields with geolocation data
                    document.getElementById('longitude').value = longitude;
                    document.getElementById('latitude').value = latitude;

                    // Get address name using reverse geocoding
                    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`)
                        .then(response => response.json())
                        .then(data => {
                            const address = data.display_name || "Unknown Address";
                            document.getElementById('address_name').value = address;

                            // Submit the form with all data
                            event.target.submit();
                        })
                        .catch(error => {
                            console.error('Error fetching the address:', error);
                            alert("Could not retrieve the address. Submitting without address.");
                            event.target.submit();
                        });
                }, function(error) {
                    console.error('Error in geolocation:', error);
                    alert("Geolocation failed. Submitting without geolocation data.");
                    event.target.submit();
                });
            } else {
                alert("Geolocation is not supported by this browser.");
                event.target.submit();
            }
        });
    </script>
</body>

</html>