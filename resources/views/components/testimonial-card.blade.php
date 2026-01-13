@props(['testimonial'])

<div class="card-custom p-4 h-100">
    <div class="mb-3">
        <i class="bi bi-quote" style="font-size: 2rem; color: var(--accent-color);"></i>
    </div>
    <p class="card-text mb-4" style="font-style: italic;">
        "{{ $testimonial->content }}"
    </p>
    <div class="d-flex align-items-center mt-auto">
        <img src="{{ $testimonial->avatar }}" alt="{{ $testimonial->name }}" 
             class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
        <div>
            <h6 class="mb-0" style="font-weight: 600;">{{ $testimonial->name }}</h6>
            <small class="text-secondary">{{ $testimonial->role }}</small>
        </div>
    </div>
</div>
