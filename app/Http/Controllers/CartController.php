<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Afficher le contenu du panier
    public function view()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::with('images')->find($productId);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'total' => $product->price * $item['quantity']
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        return view('client.products.cart', compact('products', 'total'));
    }

    // Ajouter un produit au panier
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Vérifier le stock
        if ($product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant'
            ], 400);
        }

        // Ajouter ou mettre à jour le produit dans le panier
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->product_id] = [
                'quantity' => $request->quantity,
                'price' => $product->price
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cartCount' => $this->getCartCount(),
            'message' => 'Produit ajouté au panier'
        ]);
    }

    // Mettre à jour la quantité d'un produit
    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            
            // Vérifier le stock
            if ($product->stock < $request->quantity) {
                return back()->with('error', 'Stock insuffisant');
            }

            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Panier mis à jour');
    }

    // Supprimer un produit du panier
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produit retiré du panier');
    }

    // Vider le panier
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Panier vidé');
    }

    // Passer la commande
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Votre panier est vide');
        }

        // Ici vous devrez implémenter la logique de commande
        // Par exemple créer une commande en base de données
        
        // Après création de la commande, vider le panier
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Commande passée avec succès');
    }

    // Helper pour obtenir le nombre d'articles dans le panier
    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }

    // Dans CartController.php

        public function showCheckout()
        {
            $cart = session()->get('cart', []);
            $products = [];
            $total = 0;

            foreach ($cart as $productId => $item) {
                $product = Product::with('images')->find($productId);
                if ($product) {
                    $products[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'total' => $product->price * $item['quantity']
                    ];
                    $total += $product->price * $item['quantity'];
                }
            }

            if (empty($products)) {
                return redirect()->route('cart.view')->with('error', 'Votre panier est vide');
            }

            // Récupérer les pays et villes distincts depuis la base de données
            $countries = Address::select('country')->distinct()->pluck('country');
            $towns = Address::select('town')->distinct()->pluck('town');

            return view('client.products.checkout', compact('products', 'total', 'countries', 'towns'));
        }

        public function processCheckout(Request $request)
        {
            $cart = session()->get('cart', []);
            
            if (empty($cart)) {
                return back()->with('error', 'Votre panier est vide');
            }

            // Validation des données
            $request->validate([
                'sender_name' => 'required|string|max:255',
                'sender_phone' => 'required|string|max:20',
                'sender_country' => 'required|string',
                'sender_town' => 'required|string',
                'sender_quarter' => 'required|string',
                'receiver_name' => 'required|string|max:255',
                'receiver_phone' => 'required|string|max:20',
                'receiver_country' => 'required|string',
                'receiver_town' => 'required|string',
                'receiver_quarter' => 'required|string',
                'payment' => 'required|string|in:mtn,orange',
                'payment_number' => 'required|string|max:20'
            ]);

            // Création de la commande pour chaque produit
            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                
                $order = Order::create([
                    'sender_name' => $request->sender_name,
                    'sender_phone' => $request->sender_phone,
                    'sender_town' => $request->sender_town,
                    'sender_quarter' => $request->sender_quarter,
                    'receiver_name' => $request->receiver_name,
                    'receiver_phone' => $request->receiver_phone,
                    'receiver_town' => $request->receiver_town,
                    'receiver_quarter' => $request->receiver_quarter,
                    'product_info' => $product->name,
                    'category' => $product->category->name ?? 'Non spécifiée',
                    'price' => $product->price * $item['quantity'],
                    'payment' => $request->payment,
                    'payment_number' => $request->payment_number,
                    'merchant_id' => $product->merchant_id,
                    'client_id' => auth()->id(),
                    'status' => 'Pending',
                    'verification_code' => substr(md5(uniqid()), 0, 7) // Code de vérification
                ]);

                // Lier le produit à la commande
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity']
                ]);
            }

            // Vider le panier après commande
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Votre commande a été passée avec succès');
        }
}