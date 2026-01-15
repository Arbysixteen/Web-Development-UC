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
                        <button class="btn btn-outline-custom btn-lg" onclick="toggleWishlist({{ $product->id }}, this)" 
                                id="wishlistBtn">
                            <i class="bi bi-heart{{ auth()->user()->hasInWishlist($product->id) ? '-fill text-danger' : '' }}"></i>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg flex-grow-1">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login to Buy
                        </a>
                    @endauth
                    
                    <div class="dropdown">
                        <button class="btn btn-outline-custom btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-share"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: var(--bg-secondary); border-color: var(--border-color);">
                            <li>
                                <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                   target="_blank" style="color: var(--text-primary);">
                                    <i class="bi bi-facebook me-2"></i>Facebook
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($product->name) }}" 
                                   target="_blank" style="color: var(--text-primary);">
                                    <i class="bi bi-twitter me-2"></i>Twitter
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://wa.me/?text={{ urlencode($product->name . ' - ' . request()->url()) }}" 
                                   target="_blank" style="color: var(--text-primary);">
                                    <i class="bi bi-whatsapp me-2"></i>WhatsApp
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="copyLink(); return false;" style="color: var(--text-primary);">
                                    <i class="bi bi-link-45deg me-2"></i>Copy Link
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Edit Button (Admin Only) -->
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="pt-3 border-top" style="border-color: var(--border-color) !important;">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-custom">
                                <i class="bi bi-pencil me-1"></i>Edit Product
                            </a>
                        </div>
                    @endif
                @endauth

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

        <!-- Reviews Section -->
        <div class="mt-5 pt-5 border-top" style="border-color: var(--border-color) !important;">
            <h3 class="section-title mb-4"><i class="bi bi-star me-2"></i>Customer Reviews</h3>
            
            @auth
                @if(!auth()->user()->hasReviewed($product->id))
                    <div class="card-custom p-4 mb-4">
                        <h5 class="mb-3">Write a Review</h5>
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="mb-3">
                                <label class="form-label">Your Rating</label>
                                <div class="rating-input">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" required>
                                        <label for="star{{ $i }}"><i class="bi bi-star-fill"></i></label>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Your Review (Optional)</label>
                                <textarea name="comment" class="form-control form-control-custom" rows="4" 
                                          placeholder="Share your experience with this product..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-send me-2"></i>Submit Review
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
            
            <div class="reviews-list">
                @forelse($product->reviews()->with('user')->latest()->get() as $review)
                    <div class="card-custom p-4 mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1">{{ $review->user->name }}</h6>
                                <div class="rating mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-secondary">{{ $review->created_at->diffForHumans() }}</small>
                                @auth
                                    @if($review->user_id === auth()->id())
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0 ms-2" 
                                                    onclick="return confirm('Delete this review?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="text-secondary mb-0">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <div class="card-custom p-5 text-center">
                        <i class="bi bi-chat-quote" style="font-size: 3rem; color: var(--text-secondary);"></i>
                        <p class="text-secondary mt-3 mb-0">No reviews yet. Be the first to review!</p>
                    </div>
                @endforelse
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

@push('styles')
<style>
    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.5rem;
    }
    
    .rating-input input[type="radio"] {
        display: none;
    }
    
    .rating-input label {
        cursor: pointer;
        font-size: 2rem;
        color: var(--text-secondary);
        transition: color 0.2s;
    }
    
    .rating-input input[type="radio"]:checked ~ label,
    .rating-input label:hover,
    .rating-input label:hover ~ label {
        color: #fbbf24;
    }
</style>
@endpush

@push('scripts')
<script>
function toggleWishlist(productId, button) {
    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        const icon = button.querySelector('i');
        if (data.status === 'added') {
            icon.className = 'bi bi-heart-fill text-danger';
        } else {
            icon.className = 'bi bi-heart';
        }
    });
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Link copied to clipboard!');
    });
}
</script>
@endpush
@endsection
