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
    animation: fadeIn 1s ease-in;
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

.map {
    height: 400px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
    opacity: 0;
    animation: fadeIn 1s ease forwards;
}

.courier-info p {
    font-size: 1rem;
    color: #333;
    margin-bottom: 0.5rem;
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

    .map {
        height: 500px;
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

        <div class="card wallet-card">
            <h2>Portefeuille</h2>
            <p><b>{{ number_format(auth()->user()->wallet->balance, 2) }} FCFA</b></p>
            <a href="{{ route('wallet.transaction.form') }}" class="btn">Gérer mon portefeuille</a>
        </div>

        <div id="map" class="map"></div>
        <div class="courier-info card">
            <h2>Position du Livreur</h2>
            <p id="address-name">Adresse : N/A</p>
            <p id="coordinates">Coordonnées : N/A</p>
            <p id="distance-info">Distance : N/A</p>
        </div>
        @else
        <h1>Bienvenue, invité!</h1>
        <p>Veuillez vous connecter pour accéder à votre tableau de bord.</p>
        @endif
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Animation des cartes au chargement
    const elements = document.querySelectorAll('.card, .map');
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

    // Leaflet Map Logic
    const apiKey = '5b3ce3597851110001cf6248c656d902329a4797a48fa15e350c1834';
    let senderCoordinates = [{{ $senderLatitude }}, {{ $senderLongitude }}];
    let receiverCoordinates = [{{ $receiverLatitude }}, {{ $receiverLongitude }}];
    let courierCoordinates = [0, 0];
    let routeLine;

    const map = L.map('map').setView(senderCoordinates, 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    const senderMarker = L.marker(senderCoordinates).addTo(map).bindPopup('Expéditeur');
    const receiverMarker = L.marker(receiverCoordinates).addTo(map).bindPopup('Destinataire');
    const courierMarker = L.marker(courierCoordinates).addTo(map).bindPopup('Livreur');

    function saveCourierLocation(latitude, longitude) {
        fetch(`/courier/location`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                courier_id: {{ $courierId ?? 'courierId' }},
                latitude: latitude,
                longitude: longitude,
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        })
        .catch(err => console.error('Error saving location:', err));
    }

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    courierCoordinates = [position.coords.latitude, position.coords.longitude];
                    courierMarker.setLatLng(courierCoordinates);
                    map.panTo(courierCoordinates);
                    updateCourierInfo(courierCoordinates[0], courierCoordinates[1]);
                    saveCourierLocation(courierCoordinates[0], courierCoordinates[1]);
                },
                error => console.error('Error fetching location:', error)
            );
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    function updateCourierInfo(latitude, longitude) {
        document.getElementById('coordinates').innerText = `Coordonnées : ${latitude}, ${longitude}`;
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('address-name').innerText = `Adresse : ${data.display_name || 'N/A'}`;
            })
            .catch(err => console.error('Error fetching address:', err));
    }

    function fetchRouteAndDisplayDistance(targetCoordinates, targetName) {
        if (routeLine) {
            map.removeLayer(routeLine);
        }

        const courierLatLng = `${courierCoordinates[1]},${courierCoordinates[0]}`;
        const targetLatLng = `${targetCoordinates[1]},${targetCoordinates[0]}`;

        fetch(`https://api.openrouteservice.org/v2/directions/driving-car?api_key=${apiKey}&start=${courierLatLng}&end=${targetLatLng}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.routes && data.routes.length > 0) {
                    const route = data.routes[0];
                    routeLine = L.polyline(route.geometry.coordinates.map(coord => [coord[1], coord[0]]), { color: 'blue' }).addTo(map);
                    const distance = route.summary.distance / 1000;
                    document.getElementById('distance-info').innerText = `Distance : ${distance.toFixed(2)} km`;
                } else {
                    console.error('No routes found:', data);
                }
            })
            .catch(err => console.error('Error fetching route data:', err));
    }

    senderMarker.on('click', () => fetchRouteAndDisplayDistance(senderCoordinates, 'Expéditeur'));
    receiverMarker.on('click', () => fetchRouteAndDisplayDistance(receiverCoordinates, 'Destinataire'));

    getCurrentLocation();
    setInterval(getCurrentLocation, 5000);
});
    </script>
@endsection