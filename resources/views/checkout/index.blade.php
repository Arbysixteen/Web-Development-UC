@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <section class="py-5">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="mb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"
                                style="color: var(--accent-color);">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none"
                                style="color: var(--accent-color);">Cart</a></li>
                        <li class="breadcrumb-item active text-secondary" aria-current="page">Checkout</li>
                    </ol>
                </nav>
                <h1 class="section-title mb-1">Checkout</h1>
                <p class="text-secondary mb-0">Complete your purchase</p>
            </div>

            <div class="row">
                <!-- Order Review -->
                <div class="col-lg-8 mb-4">
                    <div class="card-custom p-4 mb-4">
                        <h5 class="mb-4"><i class="bi bi-person me-2"></i>Customer Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary">Name</label>
                                <p class="fw-bold mb-0">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary">Email</label>
                                <p class="fw-bold mb-0">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary">Phone</label>
                                <p class="fw-bold mb-0">{{ auth()->user()->phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom p-4">
                        <h5 class="mb-4"><i class="bi bi-bag me-2"></i>Order Items</h5>

                        @foreach($cart->items as $item)
                            <div class="d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}"
                                style="border-color: var(--border-color) !important;">
                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="rounded"
                                    style="width: 80px; height: 60px; object-fit: cover;">

                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                    <small class="text-secondary">Qty: {{ $item->quantity }}</small>
                                </div>

                                <div class="text-end">
                                    <span class="fw-bold" style="color: var(--accent-color);">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="col-lg-4">
                    <div class="card-custom p-4">
                        <h5 class="mb-4"><i class="bi bi-credit-card me-2"></i>Payment</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-secondary">Subtotal ({{ $cart->item_count }} items)</span>
                            <span>Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-secondary">Tax</span>
                            <span>Rp 0</span>
                        </div>
                        <hr style="border-color: var(--border-color);">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5" style="color: var(--accent-color);">
                                Rp {{ number_format($cart->total, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Dummy Payment Button -->
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary-custom w-100 py-3">
                                <i class="bi bi-shield-check me-2"></i>Pay Now
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <small class="text-secondary">
                                <i class="bi bi-lock me-1"></i>Secure payment processing
                            </small>
                        </div>

                        <hr style="border-color: var(--border-color);">

                        <div class="d-flex justify-content-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/100px-Visa_Inc._logo.svg.png"
                                alt="Visa" style="height: 20px; opacity: 0.7;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/100px-Mastercard-logo.svg.png"
                                alt="Mastercard" style="height: 20px; opacity: 0.7;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection