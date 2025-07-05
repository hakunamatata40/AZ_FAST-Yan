@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - AZ</title>
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
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-light: #e9ecef;
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

        /* Support Form */
        .support-form {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            animation: fadeIn 0.8s ease 0.2s both;
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

        .form-input, .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray-light);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-input:focus, .form-textarea:focus {
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
        <!-- Header -->
        <header class="header">
            <div class="logo">
                <a href="/admin/dashboard">
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
                    <h1 class="user-name">Bienvenue, {{ auth()->user()->name }}!</h1>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            </div>
        </header>

        <!-- Support Form -->
        <div class="support-form">
            <h2 class="form-title"><i class="fas fa-headset"></i> Support Client</h2>

            <form method="POST" action="{{ route('client.support.submit') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Sujet</label>
                    <input type="text" name="subject" required class="form-input" placeholder="Entrez le sujet">
                </div>

                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" required class="form-textarea" placeholder="Entrez votre message"></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Envoyer
                </button>
            </form>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
@endsection