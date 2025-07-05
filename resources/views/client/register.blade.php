<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('AZ_fastlogo.png') }}" type="image/png">
    <title>Client Registration</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <style>:root {
            --primary: #059669;
            --primary-dark: #047857;
            --secondary: #1e40af;
            --text: #374151;
            --light: #f9fafb;
            --error-bg: #fee2e2;
            --error-text: #b91c1c;
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

        .register-card {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 500px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(0);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .register-card::before {
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
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

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
            margin-top: 20px;
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

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #6b7280;
            font-size: 15px;
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            position: relative;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
        }

        .login-link a:hover::after {
            width: 100%;
        }

        .error-container {
            margin-top: 20px;
            padding: 15px;
            background-color: var(--error-bg);
            color: var(--error-text);
            border-radius: 10px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        .error-list {
            list-style-type: disc;
            padding-left: 20px;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 30px 20px;
            }
            
            .card-title {
                font-size: 24px;
            }
        }

        /* Progress Steps */
.progress-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    margin: 30px 0 40px;
    counter-reset: step;
}

.progress-line {
    position: absolute;
    height: 4px;
    background: var(--primary);
    width: 0%;
    top: 25px;
    left: 0;
    z-index: 1;
    transition: all 0.5s ease;
}

.progress-container::before {
    content: '';
    position: absolute;
    height: 4px;
    background: #e5e7eb;
    width: 100%;
    top: 25px;
    left: 0;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    width: 33.33%;
}

.step-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e5e7eb;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    color: #9ca3af;
    border: 4px solid white;
    transition: all 0.3s ease;
}

.step.active .step-circle {
    background: var(--primary);
    color: white;
}

.step-label {
    margin-top: 10px;
    font-size: 12px;
    color: #9ca3af;
    text-align: center;
    transition: all 0.3s ease;
}

.step.active .step-label {
    color: var(--primary);
    font-weight: bold;
}

/* Form Steps */
.form-step {
    display: none;
    animation: fadeIn 0.5s ease forwards;
}

.form-step.active {
    display: block;
}

.step-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.prev-btn {
    background: #e5e7eb;
    color: var(--text);
}

.prev-btn:hover {
    background: #d1d5db;
}

/* Profile Upload */
.profile-upload-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.profile-upload-input {
    display: none;
}

.profile-upload-label {
    cursor: pointer;
}

.profile-preview {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    border: 3px dashed #d1d5db;
    transition: all 0.3s ease;
}

.profile-preview:hover {
    border-color: var(--primary);
    background: #e5e7eb;
}

.profile-preview i {
    font-size: 40px;
    color: #9ca3af;
    margin-bottom: 10px;
}

.profile-preview span {
    font-size: 14px;
    color: #6b7280;
}

.profile-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Interests Grid */
.interests-container {
    margin: 20px 0;
}

.interests-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
    margin-top: 10px;
}

.interest-checkbox {
    display: none;
}

.interest-label {
    display: block;
    padding: 12px;
    background: #f3f4f6;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
    font-size: 14px;
}

.interest-checkbox:checked + .interest-label {
    background: var(--primary);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(5, 150, 105, 0.3);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .interests-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
    
    .step-label {
        font-size: 10px;
    }
    
    .step-circle {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }
}</style>
    <div class="register-card">
        <!-- Card Header -->
        <div class="card-header">
            <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo">
            <h1 class="card-title">S'inscrire</h1>
        </div>

        <!-- Progress Steps -->
        <div class="progress-container">
            <div class="progress-line" id="progress-line"></div>
            <div class="step active" data-step="1">
                <div class="step-circle">1</div>
                <div class="step-label">Infos</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-circle">2</div>
                <div class="step-label">Centres d'intérêt</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-circle">3</div>
                <div class="step-label">Photo</div>
            </div>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('client.register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Step 1: Basic Info -->
            <div class="form-step active" id="step-1">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Nom Complet</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone">Numéro de Téléphone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation">Confirmation Mot de Passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <button type="button" class="btn next-btn" data-next="2">Suivant</button>
            </div>

            <!-- Step 2: Interests -->
            <div class="form-step" id="step-2">
                <!-- Interests Field -->
                <div class="form-group interests-container">
                    <label>Centres d'intérêt (Sélectionnez au moins 1)</label>
                    <div class="interests-grid">
                        @foreach($categories as $category)
                            <div>
                                <input type="checkbox" name="interests[]" id="interest-{{ $category->id }}" 
                                       value="{{ $category->id }}" class="interest-checkbox">
                                <label for="interest-{{ $category->id }}" class="interest-label">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="step-buttons">
                    <button type="button" class="btn prev-btn" data-prev="1">Précédent</button>
                    <button type="button" class="btn next-btn" data-next="3">Suivant</button>
                </div>
            </div>

            <!-- Step 3: Profile Photo -->
            <div class="form-step" id="step-3">
                <div class="form-group">
                    <label for="profile_image">Photo de profil</label>
                    <div class="profile-upload-container">
                        <input type="file" name="profile_image" id="profile_image" class="profile-upload-input" accept="image/*">
                        <label for="profile_image" class="profile-upload-label">
                            <div class="profile-preview" id="profile-preview">
                                <i class="fas fa-user-plus"></i>
                                <span>Choisir une photo</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="step-buttons">
                    <button type="button" class="btn prev-btn" data-prev="2">Précédent</button>
                    <button type="submit" class="btn">S'inscrire</button>
                </div>
            </div>
        </form>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="error-container">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Log In Link -->
        <p class="login-link">
            Déjà un compte? <a href="{{ route('login') }}">Connectez-vous</a>
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Step navigation
            const nextButtons = document.querySelectorAll('.next-btn');
            const prevButtons = document.querySelectorAll('.prev-btn');
            const steps = document.querySelectorAll('.form-step');
            const progressSteps = document.querySelectorAll('.step');
            const progressLine = document.getElementById('progress-line');

            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nextStep = this.getAttribute('data-next');
                    const currentStep = document.querySelector('.form-step.active');
                    
                    // Validate current step before proceeding
                    if (validateStep(currentStep.id)) {
                        currentStep.classList.remove('active');
                        document.getElementById(`step-${nextStep}`).classList.add('active');
                        updateProgress(nextStep);
                    }
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const prevStep = this.getAttribute('data-prev');
                    document.querySelector('.form-step.active').classList.remove('active');
                    document.getElementById(`step-${prevStep}`).classList.add('active');
                    updateProgress(prevStep);
                });
            });

            // Profile image preview
            const profileInput = document.getElementById('profile_image');
            const profilePreview = document.getElementById('profile-preview');

            profileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Update progress indicator
            function updateProgress(step) {
                progressSteps.forEach((stepElement, index) => {
                    if (index < step) {
                        stepElement.classList.add('active');
                    } else {
                        stepElement.classList.remove('active');
                    }
                });

                // Update progress line
                const activeSteps = document.querySelectorAll('.step.active').length;
                const totalSteps = progressSteps.length;
                const progressPercent = ((activeSteps - 1) / (totalSteps - 1)) * 100;
                progressLine.style.width = `${progressPercent}%`;
            }

            // Simple step validation
            function validateStep(stepId) {
                if (stepId === 'step-1') {
                    const requiredFields = ['name', 'email', 'phone', 'password', 'password_confirmation'];
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        const input = document.getElementById(field);
                        if (!input.value.trim()) {
                            input.style.borderColor = 'var(--error-text)';
                            isValid = false;
                        } else {
                            input.style.borderColor = '';
                        }
                    });

                    if (!isValid) {
                        alert('Veuillez remplir tous les champs obligatoires');
                    }
                    return isValid;
                } else if (stepId === 'step-2') {
                    const checkedInterests = document.querySelectorAll('.interest-checkbox:checked').length;
                    if (checkedInterests < 1) {
                        alert('Veuillez sélectionner au moins un centre d\'intérêt');
                        return false;
                    }
                    return true;
                }
                return true;
            }
        });
    </script>
</body>

</html>