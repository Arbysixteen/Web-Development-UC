@props(['product'])

<div class="card-custom h-100">
    <div class="position-relative">
        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}"
            style="height: 200px; object-fit: cover;">
        <span class="badge-custom position-absolute" style="top: 12px; left: 12px;">
            {{ $product->category }}
        </span>
    </div>
    <div class="card-body p-4">
        <h5 class="card-title mb-2" style="font-weight: 600;">{{ $product->name }}</h5>
        <p class="card-text text-secondary mb-3" style="font-size: 0.9rem;">
            {{ Str::limit($product->description, 80) }}
        </p>
        <div class="d-flex align-items-center mb-3">
            <div class="rating me-2">
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
            <small class="text-secondary">{{ $product->rating }} ({{ $product->sold }} sold)</small>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-custom btn-sm">
                <i class="bi bi-eye me-1"></i>View
            </a>
        </div>

        @auth
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary-custom btn-sm w-100">
                    <i class="bi bi-cart-plus me-1"></i>Add to Cart
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-sm w-100">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login to Buy
            </a>
        @endauth
    </div>
</div>