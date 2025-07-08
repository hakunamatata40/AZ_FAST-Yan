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

.no-data {
    font-size: 1rem;
    color: #6b7280;
    text-align: center;
}

.btn {
    display: inline-block;
    background: #2563eb;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease, transform 0.3s ease;
}

.btn:hover {
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
}
</style>
<div class="container">
        <h1>Vos Commandes</h1>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Nom du Produit</th>
                        <th>Destinataire</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders->isEmpty())
                        <tr>
                            <td colspan="5" class="no-data">Aucune commande trouvée.</td>
                        </tr>
                    @else
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->receiver_name }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn table-btn">Voir</a>
                                    @if($order->status == 'In Transit')
                                        <a href="{{ route('orders.track', $order->id) }}" class="btn track-btn">Suivre</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Animation du tableau au chargement
    const table = document.querySelector('.table-container');
    if (table) {
        table.style.animationDelay = '0.2s';
    }

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
