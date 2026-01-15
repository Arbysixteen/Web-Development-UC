@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<section class="py-5">
    <div class="container py-4">
        <div class="mb-5">
            <h1 class="section-title mb-1"><i class="bi bi-heart me-2"></i>My Wishlist</h1>
            <p class="text-secondary mb-0">Your favorite products</p>
        </div>

        @if($wishlists->isEmpty())
            <div class="card-custom p-5 text-center">
                <i class="bi bi-heart" style="font-size: 4rem; color: var(--text-secondary);"></i>
                <h4 class="mt-3">Your wishlist is empty</h4>
                <p class="text-secondary mb-4">Start adding products you love!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary-custom">
                    <i class="bi bi-grid me-2"></i>Browse Products
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card-custom h-100">
                            <div class="position-relative">
                                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}"
                                    style="height: 200px; object-fit: cover;">
                                <span class="badge-custom position-absolute" style="top: 12px; left: 12px;">
                                    {{ $product->category }}
                                </span>
                                <button class="btn btn-sm position-absolute" 
                                        style="top: 12px; right: 12px; background: var(--card-bg); border: none;"
                                        onclick="removeFromWishlist({{ $product->id }}, this)">
                                    <i class="bi bi-heart-fill text-danger"></i>
                                </button>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                <p class="card-text text-secondary mb-3" style="font-size: 0.9rem;">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-custom btn-sm">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
function removeFromWishlist(productId, button) {
    if (!confirm('Remove this product from wishlist?')) return;
    
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
        if (data.status === 'removed') {
            button.closest('.col-md-6').remove();
            
            if (document.querySelectorAll('.col-md-6').length === 0) {
                location.reload();
            }
        }
    });
}
</script>
@endpush
@endsection
