@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);">
    <div class="container">
        <div class="row align-items-center min-vh-75 py-5">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge-custom mb-3 d-inline-block">
                    <i class="bi bi-lightning-charge me-1"></i>Premium Digital Products
                </span>
                <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">
                    Solusi Digital untuk <br>
                    <span style="color: var(--accent-color);">Bisnis Modern</span> Anda
                </h1>
                <p class="lead text-secondary mb-4">
                    Temukan berbagai produk digital berkualitas dan jasa pembuatan website profesional. 
                    Dari frontend hingga fullstack, kami siap membantu mewujudkan proyek digital Anda.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-primary-custom btn-lg">
                        <i class="bi bi-grid me-2"></i>Explore Products
                    </a>
                    <a href="#services" class="btn btn-outline-custom btn-lg">
                        <i class="bi bi-info-circle me-2"></i>Our Services
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="row mt-5 pt-4">
                    <div class="col-4">
                        <h3 class="fw-bold mb-0" style="color: var(--accent-color);">500+</h3>
                        <small class="text-secondary">Products</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-0" style="color: var(--accent-color);">1000+</h3>
                        <small class="text-secondary">Customers</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-0" style="color: var(--accent-color);">99%</h3>
                        <small class="text-secondary">Satisfaction</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="p-4 rounded-4" style="background: var(--bg-tertiary); border: 1px solid var(--border-color);">
                        <img src="https://picsum.photos/seed/hero/600/400" alt="Hero Image" 
                             class="img-fluid rounded-3" style="width: 100%;">
                    </div>
                    <!-- Floating Cards -->
                    <div class="position-absolute p-3 rounded-3 shadow-lg" 
                         style="background: var(--card-bg); border: 1px solid var(--border-color); bottom: -20px; left: -20px;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; background: var(--success-color);">
                                <i class="bi bi-check-lg text-white"></i>
                            </div>
                            <div>
                                <small class="text-secondary d-block">Project Completed</small>
                                <span class="fw-bold">2,500+</span>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute p-3 rounded-3 shadow-lg" 
                         style="background: var(--card-bg); border: 1px solid var(--border-color); top: -10px; right: -10px;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <span class="fw-bold">4.9</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-custom mb-3 d-inline-block">Our Services</span>
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle mx-auto" style="max-width: 600px;">
                Kami menyediakan berbagai layanan pengembangan web profesional sesuai kebutuhan Anda.
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-4">
                    <x-service-card :service="$service" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5" style="background: var(--bg-secondary);">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
            <div>
                <span class="badge-custom mb-3 d-inline-block">Featured</span>
                <h2 class="section-title mb-0">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-custom">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-md-6 col-lg-4">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge-custom mb-3 d-inline-block">Why Choose Us</span>
                <h2 class="section-title">Mengapa Memilih Kami?</h2>
                <p class="text-secondary mb-4">
                    Kami berkomitmen memberikan layanan terbaik dengan kualitas premium dan harga kompetitif.
                </p>
                
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.1);">
                                <i class="bi bi-shield-check" style="color: var(--accent-color); font-size: 1.25rem;"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Kualitas Terjamin</h5>
                            <p class="text-secondary mb-0">Setiap produk dan layanan kami telah melalui quality assurance ketat.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.1);">
                                <i class="bi bi-headset" style="color: var(--accent-color); font-size: 1.25rem;"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Support 24/7</h5>
                            <p class="text-secondary mb-0">Tim support kami siap membantu Anda kapan saja.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.1);">
                                <i class="bi bi-cash-stack" style="color: var(--accent-color); font-size: 1.25rem;"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Harga Kompetitif</h5>
                            <p class="text-secondary mb-0">Harga bersaing dengan kualitas premium.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="card-custom p-4 text-center">
                            <h2 class="fw-bold mb-1" style="color: var(--accent-color);">5+</h2>
                            <p class="text-secondary mb-0">Years Experience</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-custom p-4 text-center">
                            <h2 class="fw-bold mb-1" style="color: var(--accent-color);">100+</h2>
                            <p class="text-secondary mb-0">Expert Developers</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-custom p-4 text-center">
                            <h2 class="fw-bold mb-1" style="color: var(--accent-color);">500+</h2>
                            <p class="text-secondary mb-0">Digital Products</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-custom p-4 text-center">
                            <h2 class="fw-bold mb-1" style="color: var(--accent-color);">24/7</h2>
                            <p class="text-secondary mb-0">Customer Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background: var(--bg-secondary);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-custom mb-3 d-inline-block">Testimonials</span>
            <h2 class="section-title">Apa Kata Mereka</h2>
            <p class="section-subtitle mx-auto" style="max-width: 600px;">
                Dengarkan pengalaman dari pelanggan kami yang telah menggunakan layanan kami.
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-md-4">
                    <x-testimonial-card :testimonial="$testimonial" />
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center p-5 rounded-4" style="background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));">
            <h2 class="display-5 fw-bold mb-3 text-white">Siap Memulai Proyek Anda?</h2>
            <p class="lead text-white opacity-75 mb-4">
                Hubungi kami sekarang dan wujudkan ide digital Anda bersama tim profesional kami.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-4">
                    <i class="bi bi-grid me-2"></i>Browse Products
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="bi bi-plus-lg me-2"></i>Add Product
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .min-vh-75 {
        min-height: 75vh;
    }
</style>
@endpush
