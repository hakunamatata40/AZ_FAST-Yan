@extends('layouts.merchant')

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
    animation: fadeIn 1s ease-in;
}

.header, .superadmin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #ffffff, #e5e7eb);
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.superadmin-header {
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    color: #fff;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-left span {
    font-size: 1.2rem;
    font-weight: 600;
}

.logo {
    height: 40px;
    transition: transform 0.3s ease;
}

.logo:hover {
    transform: scale(1.1);
}

.header-right, .superadmin-header nav {
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

.logout-btn, .superadmin-btn {
    background: none;
    border: none;
    color: #ef4444;
    font-size: 0.9rem;
    cursor: pointer;
    transition: color 0.3s ease, transform 0.3s ease;
}

.superadmin-btn {
    background: #ef4444;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
}

.superadmin-btn[href] {
    background: #10b981;
}

.logout-btn:hover, .superadmin-btn:hover {
    color: #b91c1c;
    transform: scale(1.05);
}

.superadmin-btn[href]:hover {
    background: #059669;
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
    background: #fff;
    color: #059669;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background: #f3f4f6;
    color: #047857;
    transform: translateY(-2px);
}

.add-btn, .submit-btn {
    background: #2563eb;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.add-btn:hover, .submit-btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
}

.table-btn {
    background: #2563eb;
    color: #fff;
}

.table-btn:hover {
    background: #1e40af;
}

.edit-btn {
    background: #f59e0b;
    color: #fff;
}

.edit-btn:hover {
    background: #d97706;
}

.delete-btn {
    background: #ef4444;
    color: #fff;
}

.delete-btn:hover {
    background: #b91c1c;
}

.alert {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 1rem;
    opacity: 0;
    animation: fadeIn 0.5s ease forwards;
}

.alert-success {
    background: #10b981;
    color: #fff;
}

.alert-error {
    background: #ef4444;
    color: #fff;
}

.form-card {
    background: #ffffff;
    padding: 20px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-size: 1rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-group textarea {
    min-height: 100px;
    resize: vertical;
}

.form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 5px rgba(37, 99, 235, 0.3);
}

.error {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.25rem;
    display: block;
}

.info-section, .action-section {
    margin-bottom: 1.5rem;
}

.info-section p {
    font-size: 1rem;
    color: #6b7280;
}

.no-data {
    font-size: 1rem;
    color: #6b7280;
    text-align: center;
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
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.no-image {
    color: #6b7280;
}

.tab-nav {
    display: flex;
    list-style: none;
    padding: 0;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #e5e7eb;
}

.tab-item {
    padding: 10px 20px;
    cursor: pointer;
    font-size: 1rem;
    color: #6b7280;
    transition: color 0.3s ease, border-bottom 0.3s ease;
}

.tab-item:hover {
    color: #2563eb;
}

.tab-item.active {
    color: #2563eb;
    border-bottom: 2px solid #2563eb;
}

.tab-content .tab-pane {
    display: none;
}

.tab-content .tab-pane.active {
    display: block;
    animation: fadeIn 0.5s ease;
}

.product-list {
    list-style: none;
    padding: 0;
}

.product-item {
    background: #ffffff;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 1rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.product-item:hover {
    transform: translateY(-5px);
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

    .header, .superadmin-header {
        padding: 20px;
    }

    .card h2 {
        font-size: 1.8rem;
    }

    .card p {
        font-size: 1.3rem;
    }

    .form-card {
        max-width: 600px;
        margin: 0 auto;
    }

    .tab-nav {
        justify-content: flex-start;
        gap: 20px;
    }
}
</style>

<div class="container">
        <h1>Notifications de Commandes</h1>

        <ul class="tab-nav">
            <li class="tab-item active" data-tab="pending">En Attente</li>
            <li class="tab-item" data-tab="in-transit">En Transit</li>
            <li class="tab-item" data-tab="success">Complétées</li>
            <li class="tab-item" data-tab="canceled">Annulées</li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="pending">
                <h3>Commandes en Attente</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Commande</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->client->name }}</td>
                                    <td>
                                        <a href="{{ route('merchant.orders.show', $order->id) }}" class="btn table-btn">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="in-transit">
                <h3>Commandes en Transit</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Commande</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inTransitOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->client->name }}</td>
                                    <td>
                                        <a href="{{ route('merchant.orders.show', $order->id) }}" class="btn table-btn">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="success">
                <h3>Commandes Complétées</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Commande</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($successOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->client->name }}</td>
                                    <td>
                                        <a href="{{ route('merchant.orders.show', $order->id) }}" class="btn table-btn">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="canceled">
                <h3>Commandes Annulées</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Commande</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($canceledOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->client->name }}</td>
                                    <td>
                                        <a href="{{ route('merchant.orders.show', $order->id) }}" class="btn table-btn">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Animation des cartes, alertes et éléments de liste au chargement
    const elements = document.querySelectorAll('.card, .alert, .product-item, .table-container');
    elements.forEach((element, index) => {
        element.style.animationDelay = `${index * 0.2}s`;
    });

    // Animation au survol des boutons et liens
    const buttons = document.querySelectorAll('.btn, .link, .logout-btn, .submit-btn, .edit-btn, .delete-btn, .table-btn, .superadmin-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'scale(1.05)';
        });
        button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
        });
    });

    // Animation des champs de formulaire au focus
    const inputs = document.querySelectorAll('.form-group input, .form-group textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.querySelector('label').style.color = '#2563eb';
        });
        input.addEventListener('blur', () => {
            input.parentElement.querySelector('label').style.color = '#333';
        });
    });

    // Gestion des onglets pour notification.html
    const tabItems = document.querySelectorAll('.tab-item');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabItems.forEach(item => {
        item.addEventListener('click', () => {
            tabItems.forEach(i => i.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            item.classList.add('active');
            document.getElementById(item.dataset.tab).classList.add('active');
        });
    });
});
    </script>

@endsection
