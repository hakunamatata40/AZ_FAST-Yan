<?php 
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // List all products for the Merchant Client or Admin
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $products = Product::with('category', 'images')->get();
        } elseif ($user->hasRole('Merchant Client')) {
            $products = Product::with('category', 'images')->where('user_id', $user->id)->get();
        }else {
            $products = Product::with('category', 'images')->where('status', 'active')->get();
        }

        return view('products.index', compact('products'));
    }

    // Show form to create a product
    public function create($storefrontId)
    {
       // $this->authorize('create', Product::class);

        $categories = Category::all(); // Get all categories
       
        return view('products.create', compact('categories', 'storefrontId'));

    }

    // Store a new product in the database
   public function store1(Request $request)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'storefront_id' => 'required|exists:storefronts,id',
        'merchant_id' => 'required|exists:merchants,id',
    ]);

    // Create the product
    $product = Product::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'storefront_id' => $request->storefront_id,
        'merchant_id' => $request->merchant_id,
        'category_id' => $request->category_id,
    ]);

    // Handle image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            // Générer un nom unique pour l'image
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Déplacer l'image vers public/products
            $image->move(public_path('products'), $imageName);
            
            // Enregistrer dans la base de données
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/' . $imageName, // Chemin relatif depuis public
            ]);
        }
    }

    return redirect()->route('storefronts.show', $request->storefront_id)
        ->with('success', 'Product created successfully with images!');
    }

    // Update an existing product in the database
    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Update product details
        $product->update($request->except(['images', 'delete_images']));

        // Handle image deletion if requested
        if ($request->has('delete_images') && is_array($request->delete_images)) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image) {
                    try {
                        // Delete from local storage
                        $path = str_replace('storage/', 'public/', $image->image_path);
                        Storage::delete($path);
                        
                        // Delete the record from your database
                        $image->delete();
                    } catch (\Exception $e) {
                        \Log::error("Failed to delete image for ProductImage ID {$imageId}: " . $e->getMessage());
                    }
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate a unique file name
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Store the image in the public/products directory
                $path = $image->storeAs('public/products', $imageName);
                
                // Create a record in the product_images table
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'storage/products/' . $imageName,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        // Delete associated images from local storage first
        foreach ($product->images as $image) {
            try {
                $path = str_replace('storage/', 'public/', $image->image_path);
                Storage::delete($path);
            } catch (\Exception $e) {
                \Log::error("Failed to delete image during product destroy for URL: {$image->image_path}. Error: " . $e->getMessage());
            }
        }

        // Delete the product itself
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product and associated images deleted successfully!');
    }
    // Show form to edit a product
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all(); // Get all categories
        return view('products.edit', compact('product', 'categories'));
    }
// Show a specific product

public function description(Product $product)
{
    // Charge les relations nécessaires
    $product->load('category', 'images', 'user', 'merchant');
    
    // Récupère les produits similaires (même catégorie)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->with('images')
        ->take(4)
        ->get();

    return view('client.products.show', compact('product', 'relatedProducts'));
}
 

    public function show(Product $product)
    {
        $product->load(['images', 'category', 'merchant', 'user']);
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
