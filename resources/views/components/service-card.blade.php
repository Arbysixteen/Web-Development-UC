@props(['service'])

<div class="card-custom h-100 p-4">
    <div class="mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle" 
             style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));">
            <i class="{{ $service->icon }} text-white" style="font-size: 1.5rem;"></i>
        </div>
    </div>
    <h5 class="card-title mb-3" style="font-weight: 600;">{{ $service->title }}</h5>
    <p class="card-text text-secondary mb-4" style="font-size: 0.95rem;">
        {{ $service->description }}
    </p>
    <div class="mt-auto">
        <p class="mb-3">
            <small class="text-secondary">Starting from</small><br>
            <span class="price">Rp {{ number_format($service->price_start, 0, ',', '.') }}</span>
        </p>
        <a href="{{ route('products.index') }}" class="btn btn-outline-custom w-100">
            Learn More <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
