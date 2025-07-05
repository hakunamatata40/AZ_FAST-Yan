@extends('layout.app')

@section('content')
<style>
    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f5f5f5;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    .logo-section {
        display: flex;
        align-items: center;
    }
    .logo-img {
        height: 40px;
        width: auto;
        margin-right: 1rem;
    }
    .user-section {
        display: flex;
        align-items: center;
        margin-left: auto;
    }
    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .user-name {
        font-size: 1.5rem;
        font-weight: bold;
        margin-left: 0.5rem;
    }
    .logout-btn {
        color: #ef4444;
        margin-left: 1rem;
    }
    .logout-btn:hover {
        color: #dc2626;
    }
    .wallet-card {
        background-color: #10b981;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
        transition: background-color 0.3s;
    }
    .wallet-card:hover {
        background-color: #059669;
    }
    .wallet-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
    }
    .wallet-amount {
        font-size: 1.125rem;
        color: white;
        font-weight: bold;
    }
    .wallet-btn {
        background-color: white;
        color: #10b981;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        margin-top: 0.5rem;
        display: inline-block;
    }
    .wallet-btn:hover {
        background-color: #f5f5f5;
    }
    .profile-form {
        max-width: 32rem;
        margin: 0 auto;
        padding: 1rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .form-input {
        display: block;
        width: 100%;
        font-size: 0.875rem;
        color: #111827;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem;
        margin-top: 0.25rem;
    }
    .form-input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }
    .submit-btn {
        width: 100%;
        padding: 0.5rem 1rem;
        background-color: #2563eb;
        color: white;
        border-radius: 0.375rem;
        border: none;
    }
    .submit-btn:hover {
        background-color: #1d4ed8;
    }
    .image-preview {
        width: 100%;
        height: auto;
        border-radius: 0.375rem;
        display: none;
    }
    .welcome-guest {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
</style>

@if (auth()->check())
    <div class="header-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <a href="/client/dashboard">
                <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo-img">
            </a>
            <span>Add Profile Picture</span>
        </div>
        
        <!-- User Section -->
        <div class="user-section">
            @if (auth()->user()->profileImage)
                <img src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" alt="Profile Image" class="profile-img">
            @else
                <img src="{{ asset('jblogo.png') }}" alt="Default Profile Image" class="profile-img">
                <a href="{{ route('profile.edit') }}" style="color: #3b82f6; margin-left: 0.5rem;">Add profile</a>
            @endif
            
            <div class="user-name">{{ auth()->user()->name }}!</div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>
    </div>

    <!-- Wallet Information Card -->
    <div class="wallet-card">
        <h2 class="wallet-title">Wallet Amount</h2>
        <p class="wallet-amount">{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</p>
        <a href="{{ route('wallet.transaction.form') }}" class="wallet-btn">Gérer mon portefeuille</a>
    </div>
@else
    <h1 class="welcome-guest">Bienvenue, invité!</h1>
    <p style="margin-bottom: 1rem;">Veuillez vous connecter pour accéder à votre tableau de bord.</p>
@endif

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 1rem;">
        <label for="profile_image" class="form-label">Upload Profile Picture</label>
        <input type="file" name="profile_image" id="profile_image" accept="image/*" class="form-input" onchange="previewImage(event)">
    </div>

    <div style="margin-bottom: 1rem;">
        <img id="image_preview" class="image-preview" alt="Profile Image Preview">
    </div>

    <button type="submit" class="submit-btn">Update Profile</button>
</form>

<script>
function previewImage(event) {
    const imagePreview = document.getElementById('image_preview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block'; // Show the image
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none'; // Hide the image if no file is selected
    }
}
</script>
@endsection