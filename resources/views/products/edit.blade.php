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

h2 {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 1.5rem;
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
    transition: color 0.3s ease, transform 0.3s ease;
}

.logout-btn:hover {
    color: #b91c1c;
    transform: scale(1.05);
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

.card h2 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 5px rgba(37, 99, 235, 0.3);
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

.form-note {
    font-size: 0.9rem;
    color: #6b7280;
    margin-top: 5px;
    display: block;
}

.error-message {
    color: #ef4444;
    font-size: 0.9rem;
    margin-top: 5px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease, transform 0.3s ease;
}

.btn.submit-btn {
    background: #2563eb;
    color: #fff;
}

.btn.submit-btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
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

    h2 {
        font-size: 2rem;
    }

    .header {
        padding: 20px;
    }

    .card h2 {
        font-size: 1.8rem;
    }
}
</style>
<div class="container">
        @if (auth()->check())
        <header class="header">
            <div class="header-left">
                <a href="/merchant/dashboard">
                    <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo">
                </a>
            </div>
            <div class="header-right">
                @if (auth()->user()->profileImage)
                    <img src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" alt="Profile Image" class="profile-img">
                @else
                    <img src="{{ asset('jblogo.png') }}" alt="Default Profile Image" class="profile-img">
                    <a href="{{ route('profile.edit') }}" class="profile-link">Ajouter un profil</a>
                @endif
                <div class="user-info">
                    <h2>{{ auth()->user()->name }}!</h2>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            </div>
        </header>

        <div class="card form-card">
            <h2>Modifier le Produit : {{ $product->name }}</h2>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nom du Produit</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Prix</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" required>
                    @error('price')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required>
                    @error('stock')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Catégorie</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="images">Images du Produit</label>
                    <input type="file" name="images[]" id="images" multiple class="form-control">
                    <small class="form-note">Laissez vide si vous ne souhaitez pas modifier les images.</small>
                    @error('images')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn submit-btn">Mettre à Jour le Produit</button>
            </form>
        </div>
        @else
        <h1>Bienvenue, invité!</h1>
        <p>Veuillez vous connecter pour accéder à votre tableau de bord.</p>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Animation des éléments au chargement
    const elements = document.querySelectorAll('.card, .header');
    elements.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.2}s`;
    });

    // Animation au survol des boutons et liens
    const buttons = document.querySelectorAll('.btn, .profile-link, .logout-btn');
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
