<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes</title>
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --secondary-color: #f3f4f6;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Header Styles */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .page-header:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .logo-container img {
            height: 2.5rem;
            width: auto;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-pic {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .profile-pic:hover {
            border-color: var(--primary-color);
        }

        .user-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-color);
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            font-weight: 500;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }

        /* Page Title */
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            position: relative;
            padding-left: 1rem;
        }

        .page-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--light-text);
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        /* Table Styles */
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.5s ease;
        }

        .orders-table thead {
            background-color: var(--secondary-color);
        }

        .orders-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--text-color);
            border-bottom: 1px solid var(--border-color);
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tr {
            transition: all 0.3s ease;
        }

        .orders-table tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-in-transit {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }

        .status-delivered {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        /* Action Button */
        .track-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--primary-color);
            color: white;
            border-radius: 0.375rem;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .track-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3), 0 2px 4px -1px rgba(59, 130, 246, 0.1);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .user-info {
                width: 100%;
                justify-content: space-between;
            }

            .orders-table {
                display: block;
                overflow-x: auto;
            }

            .orders-table th, 
            .orders-table td {
                min-width: 150px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.25rem;
            }

            .user-name {
                font-size: 1rem;
            }

            .orders-table th, 
            .orders-table td {
                padding: 0.75rem;
                font-size: 0.875rem;
            }

            .track-btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        .slide-up {
            animation: slideUp 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="page-header">
            <div class="logo-container">
                <a href="/client/dashboard">
                    <img src="{{ asset('AZ_fastlogo.png') }}" alt="Logo">
                </a>
            </div>
            
            <div class="user-info">
                @if (auth()->user()->profileImage)
                    <img src="{{ asset('storage/' . auth()->user()->profileImage->image_path) }}" alt="Profile Image" class="profile-pic">
                @else
                    <img src="{{ asset('jblogo.png') }}" alt="Default Profile Image" class="profile-pic">
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 ml-2">Add profile</a>
                @endif
                
                <h1 class="user-name">{{ auth()->user()->name }}!</h1>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            </div>
        </header>

        <h2 class="page-title">Mes Commandes</h2>

        @if($orders->isEmpty())
            <p class="empty-state">Vous n'avez pas encore de commandes.</p>
        @else
            <div class="overflow-x-auto slide-up">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID de Commande</th>
                            <th>Infos Produit</th>
                            <th>Quartier Expéditeur</th>
                            <th>Quartier Destinataire</th>
                            <th>Code de Commande</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="fade-in">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product_info }}</td>
                                <td>{{ $order->sender_quarter ?? 'N/A' }}</td>
                                <td>{{ $order->receiver_quarter ?? 'N/A' }}</td>
                                <td>{{ $order->verification_code ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        switch($order->status) {
                                            case 'In Transit':
                                                $statusClass = 'status-in-transit';
                                                break;
                                            case 'Delivered':
                                                $statusClass = 'status-delivered';
                                                break;
                                            case 'Pending':
                                                $statusClass = 'status-pending';
                                                break;
                                            case 'Cancelled':
                                                $statusClass = 'status-cancelled';
                                                break;
                                            default:
                                                $statusClass = 'status-pending';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ $order->status }}</span>
                                </td>
                                <td>
                                    @if($order->status === 'In Transit')
                                        <a href="{{ route('client.orders.track', $order->id) }}" class="track-btn">Suivre la Commande</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation for table rows
            const tableRows = document.querySelectorAll('.orders-table tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
            });

            // Add hover effect to buttons
            const buttons = document.querySelectorAll('.track-btn, .logout-btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    button.style.transform = 'translateY(-1px)';
                });
                button.addEventListener('mouseleave', () => {
                    button.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>