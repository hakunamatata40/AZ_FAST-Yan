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

.action-section {
    margin-bottom: 1.5rem;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease, transform 0.3s ease;
}

.add-btn {
    background: #2563eb;
    color: #fff;
}

.add-btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
}

.view-btn {
    background: #3b82f6;
    color: #fff;
}

.view-btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
}

.edit-btn {
    background: #f59e0b;
    color: #fff;
}

.edit-btn:hover {
    background: #d97706;
    transform: translateY(-2px);
}

.delete-btn {
    background: #ef4444;
    color: #fff;
}

.delete-btn:hover {
    background: #b91c1c;
    transform: translateY(-2px);
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
}

thead {
    background: #e5e7eb;
    text-transform: uppercase;
    font-size: 0.85rem;
    color: #4b5563;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

tr:hover {
    background: #f3f4f6;
}

.product-img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
    transition: transform 0.3s ease;
}

.product-img:hover {
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
}
</style>
    <div class="container">
        <h1>Produits</h1>
        <div class="action-section">
            <a href="{{ route('client.products.index') }}" class="btn add-btn">Ajouter un Nouveau Produit</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->images->count())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="Product Image" class="product-img">
                                @else
                                    <span>Aucune Image</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }} FCFA</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn view-btn">Voir</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn edit-btn">Modifier</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-btn" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Animation des éléments au chargement
    const elements = document.querySelectorAll('.action-section, .table-container');
    elements.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.2}s`;
        element.classList.add('slideUp');
    });

    // Animation au survol des boutons
    const buttons = document.querySelectorAll('.btn');
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
