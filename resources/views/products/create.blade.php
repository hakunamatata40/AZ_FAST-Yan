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

.header-left span {
    font-size: 1.2rem;
    color: #333;
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

.card.wallet-card {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card.wallet-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.card h2 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.card p {
    font-size: 1.2rem;
    margin-bottom: 1rem;
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

.btn.add-image-btn {
    background: #6b7280;
    color: #fff;
    margin-top: 10px;
}

.btn.add-image-btn:hover {
    background: #4b5563;
    transform: translateY(-2px);
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

.image-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    margin-bottom: 1.5rem;
}

.image-preview img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.image-preview img:hover {
    transform: scale(1.05);
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

    .card p {
        font-size: 1.3rem;
    }
}
</style>
<div class="container">
        @if (auth()->check())
        <header class="header">
            <div class="header-left">
                <a href="/client/dashboard">
                    <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo" class="logo">
                </a>
                <span>Tableau de Bord Marchand</span>
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

        <div class="card wallet-card">
            <h2>Portefeuille</h2>
            <p><b>{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</b></p>
            <a href="{{ route('wallet.transaction.form') }}" class="btn">Gérer mon portefeuille</a>
        </div>

        <h1>Ajouter un Produit</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="card form-card">
            @csrf
            <input type="hidden" name="storefront_id" value="{{ $storefrontId }}">
            <input type="hidden" name="merchant_id" value="{{ auth()->user()->merchant->id }}">

            <div class="form-group">
                <label for="name">Nom du Produit</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Prix</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Sélectionner une Catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="images">Images du Produit</label>
                <div id="image-fields">
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                </div>
                <button type="button" id="add-image" class="btn add-image-btn">Ajouter des Images</button>
            </div>

            <div id="image-preview" class="image-preview"></div>

            <button type="submit" class="btn submit-btn">Ajouter le Produit</button>
        </form>
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

    // Gestion de l'ajout d'images et prévisualisation
    const addImageButton = document.getElementById('add-image');
    const imageFieldsContainer = document.getElementById('image-fields');
    const previewContainer = document.getElementById('image-preview');

    addImageButton.addEventListener('click', () => {
        const newImageInput = document.createElement('input');
        newImageInput.type = 'file';
        newImageInput.name = 'images[]';
        newImageInput.className = 'form-control';
        newImageInput.accept = 'image/*';
        newImageInput.addEventListener('change', (event) => {
            displayImagePreview(event.target.files);
        });
        imageFieldsContainer.appendChild(newImageInput);
    });

    function displayImagePreview(files) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-img';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }

    const initialImageInput = document.querySelector('input[type="file"]');
    initialImageInput.addEventListener('change', (event) => {
        displayImagePreview(event.target.files);
    });
});
    </script>
@endsection
