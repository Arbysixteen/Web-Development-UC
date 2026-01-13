<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products with search, filter, and sort.
     * GET /products
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (int) $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (int) $request->input('max_price'));
        }

        // Sort by name or price
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('sold', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Paginate results (15 products per page = 5 pages for 75 products)
        $products = $query->paginate(15)->withQueryString();

        // Get all categories for the filter dropdown
        $categories = Product::distinct()->pluck('category')->filter();

        return view('products.list', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     * GET /products/create
     */
    public function create()
    {
        return view('products.form', [
            'product' => null,
            'action' => route('products.store'),
            'method' => 'POST',
            'title' => 'Add New Product'
        ]);
    }

    /**
     * Store a newly created product.
     * POST /products/store
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // In a real application, save to database
        // Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product.
     * GET /products/show/{id}
     */
    public function show($id)
    {
        // Generate sample product data
        $categories = ['Frontend', 'Backend', 'Fullstack', 'E-Book', 'Template', 'Plugin'];
        $types = ['Website Development', 'Mobile App', 'UI/UX Design', 'API Integration', 'Database Design'];

        $product = (object) [
            'id' => $id,
            'name' => $types[array_rand($types)] . ' Package ' . $id,
            'description' => 'Professional development service with modern technologies and best practices. Includes full source code, documentation, and 30 days support.',
            'price' => rand(100, 5000) * 1000,
            'category' => $categories[array_rand($categories)],
            'image' => 'https://picsum.photos/seed/' . $id . '/800/600',
            'rating' => rand(35, 50) / 10,
            'sold' => rand(10, 500),
            'features' => [
                'Responsive Design',
                'Modern UI/UX',
                'SEO Optimized',
                'Fast Loading',
                'Cross-browser Compatible',
                '30 Days Support'
            ]
        ];

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     * GET /products/edit/{id}
     */
    public function edit($id)
    {
        // Sample product data for editing
        $product = (object) [
            'id' => $id,
            'name' => 'Sample Product ' . $id,
            'description' => 'This is a sample product description for editing.',
            'price' => 1500000,
        ];

        return view('products.form', [
            'product' => $product,
            'action' => route('products.update', $id),
            'method' => 'POST',
            'title' => 'Edit Product'
        ]);
    }

    /**
     * Update the specified product.
     * POST /products/update/{id}
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // In a real application, update in database
        // Product::findOrFail($id)->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }
}
