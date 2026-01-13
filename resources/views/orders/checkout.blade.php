@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="py-5">
    <div class="container py-4">
        <div class="mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none" style="color: var(--accent-color);">Cart</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Checkout</li>
                </ol>
            </nav>
            <h1 class="section-title mb-1">Checkout</h1>
            <p class="text-secondary mb-0">Complete your order</p>
        </div>

        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="card-custom p-4 mb-4">
                    <h5 class="mb-4"><i class="bi bi-truck me-2"></i>Shipping Information</h5>
                    
                    <form method="POST" action="{{ route('orders.process-checkout') }}" id="checkoutForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label fw-semibold">Shipping Address</label>
                            <textarea class="form-control form-control-custom @error('shipping_address') is-invalid @enderror" 
                                      id="shipping_address" 
                                      name="shipping_address" 
                                      rows="3" 
                                      placeholder="Enter your complete address"
                                      required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label fw-semibold">City</label>
                                <input type="text" class="form-control form-control-custom @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city') }}" 
                                       placeholder="Enter city" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="postal_code" class="form-label fw-semibold">Postal Code</label>
                                <input type="text" class="form-control form-control-custom @error('postal_code') is-invalid @enderror" 
                                       id="postal_code" name="postal_code" value="{{ old('postal_code') }}" 
                                       placeholder="Enter postal code" required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input type="tel" class="form-control form-control-custom @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" 
                                   placeholder="Enter phone number" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mb-3 mt-4"><i class="bi bi-credit-card me-2"></i>Payment Method</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="payment_method" id="bank_transfer" value="bank_transfer" required>
                                <label class="btn btn-outline-custom w-100 py-3" for="bank_transfer">
                                    <i class="bi bi-bank d-block mb-2" style="font-size: 1.5rem;"></i>
                                    Bank Transfer
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="payment_method" id="credit_card" value="credit_card">
                                <label class="btn btn-outline-custom w-100 py-3" for="credit_card">
                                    <i class="bi bi-credit-card d-block mb-2" style="font-size: 1.5rem;"></i>
                                    Credit Card
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="payment_method" id="e_wallet" value="e_wallet">
                                <label class="btn btn-outline-custom w-100 py-3" for="e_wallet">
                                    <i class="bi bi-wallet2 d-block mb-2" style="font-size: 1.5rem;"></i>
                                    E-Wallet
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="btn-check" name="payment_method" id="cod" value="cod">
                                <label class="btn btn-outline-custom w-100 py-3" for="cod">
                                    <i class="bi bi-cash d-block mb-2" style="font-size: 1.5rem;"></i>
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>
                        @error('payment_method')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card-custom p-4 position-sticky" style="top: 100px;">
                    <h5 class="mb-4">Order Summary</h5>
                    
                    <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                        @foreach($cart->items as $item)
                            <div class="d-flex justify-content-between mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-color: var(--border-color) !important;">
                                <div class="d-flex gap-2">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" 
                                         class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0" style="font-size: 0.9rem;">{{ Str::limit($item->product->name, 30) }}</h6>
                                        <small class="text-secondary">Qty: {{ $item->quantity }}</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="fw-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-top pt-3 mt-3" style="border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-secondary">Subtotal ({{ $cart->items->count() }} items)</span>
                            <span>Rp {{ number_format($cart->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                            <span class="text-secondary">Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0">Total</h5>
                            <h5 class="mb-0" style="color: var(--accent-color);">
                                Rp {{ number_format($cart->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}
                            </h5>
                        </div>
                        
                        <button type="submit" form="checkoutForm" class="btn btn-primary-custom w-100 py-3">
                            <i class="bi bi-check-circle me-2"></i>Place Order
                        </button>
                        
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-custom w-100 mt-2">
                            <i class="bi bi-arrow-left me-2"></i>Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .btn-check:checked + .btn-outline-custom {
        background: var(--accent-color);
        border-color: var(--accent-color);
        color: white;
    }
</style>
@endpush
