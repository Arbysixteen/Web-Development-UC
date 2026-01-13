@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="py-5">
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--accent-color);">Products</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">{{ Str::limit($product->name, 30) }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-lg-6">
                <div class="card-custom p-3">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                         class="img-fluid rounded-3 w-100" style="max-height: 500px; object-fit: cover;">
                </div>
                
                <!-- Thumbnail Gallery -->
                <div class="row g-2 mt-3">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="col-3">
                            <div class="card-custom p-2" style="cursor: pointer;">
                                <img src="https://picsum.photos/seed/thumb{{ $product->id }}{{ $i }}/150/100" 
                                     alt="Thumbnail {{ $i }}" class="img-fluid rounded">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6">
                <span class="badge-custom mb-3 d-inline-block">{{ $product->category }}</span>
                <h1 class="mb-3" style="font-weight: 700;">{{ $product->name }}</h1>
                
                <!-- Rating -->
                <div class="d-flex align-items-center mb-4 gap-3">
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($product->rating))
                                <i class="bi bi-star-fill"></i>
                            @elseif($i - 0.5 <= $product->rating)
                                <i class="bi bi-star-half"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-secondary">{{ $product->rating }} rating</span>
                    <span class="text-secondary">|</span>
                    <span class="text-secondary">{{ $product->sold }} sold</span>
                </div>

                <!-- Price -->
                <div class="mb-4 p-4 rounded-3" style="background: var(--bg-secondary);">
                    <small class="text-secondary d-block mb-1">Price</small>
                    <span class="display-5 fw-bold" style="color: var(--accent-color);">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="mb-3">Description</h5>
                    <p class="text-secondary">{{ $product->description }}</p>
                </div>

                <!-- Features -->
                @if(isset($product->features))
                <div class="mb-4">
                    <h5 class="mb-3">Features</h5>
                    <div class="row g-2">
                        @foreach($product->features as $feature)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill" style="color: var(--success-color);"></i>
                                    <span>{{ $feature }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="d-flex gap-3 flex-wrap mb-4">
                    @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg flex-grow-1">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login to Add to Cart
                        </a>
                    @endauth
                    <button class="btn btn-outline-custom btn-lg">
                        <i class="bi bi-heart"></i>
                    </button>
                    <button class="btn btn-outline-custom btn-lg">
                        <i class="bi bi-share"></i>
                    </button>
                </div>

                <!-- Edit Button -->
                <div class="pt-3 border-top" style="border-color: var(--border-color) !important;">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-custom">
                        <i class="bi bi-pencil me-1"></i>Edit Product
                    </a>
                </div>

                <!-- Seller Info -->
                <div class="card-custom p-4 mt-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));">
                            <i class="bi bi-shop text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">DigitalMarket Official</h6>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success">Verified Seller</span>
                                <small class="text-secondary">Jakarta, Indonesia</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-5 pt-5 border-top" style="border-color: var(--border-color) !important;">
            <h3 class="section-title mb-4">Related Products</h3>
            <div class="row g-4">
                @for($i = 1; $i <= 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        @php
                            $relatedProduct = (object) [
                                'id' => $product->id + $i,
                                'name' => 'Related Product ' . $i,
                                'description' => 'High quality digital product with modern features.',
                                'price' => rand(500, 2000) * 1000,
                                'category' => ['Frontend', 'Backend', 'Fullstack'][array_rand(['Frontend', 'Backend', 'Fullstack'])],
                                'image' => 'https://picsum.photos/seed/related' . $i . '/400/300',
                                'rating' => rand(40, 50) / 10,
                                'sold' => rand(20, 100),
                            ];
                        @endphp
                        <x-product-card :product="$relatedProduct" />
                    </div>
                @endfor
            </div>
        </div>
    </div>
</section>
@endsection
