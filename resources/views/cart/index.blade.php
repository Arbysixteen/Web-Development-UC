@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <section class="py-5">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="mb-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"
                                style="color: var(--accent-color);">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none"
                                style="color: var(--accent-color);">Products</a></li>
                        <li class="breadcrumb-item active text-secondary" aria-current="page">Cart</li>
                    </ol>
                </nav>
                <h1 class="section-title mb-1">Shopping Cart</h1>
                <p class="text-secondary mb-0">Review your items before checkout</p>
            </div>

            @if($cart->items->isEmpty())
                <div class="card-custom p-5 text-center">
                    <i class="bi bi-cart-x" style="font-size: 4rem; color: var(--text-secondary);"></i>
                    <h4 class="mt-3">Your cart is empty</h4>
                    <p class="text-secondary">Start shopping to add items to your cart.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary-custom">
                        <i class="bi bi-grid me-2"></i>Browse Products
                    </a>
                </div>
            @else
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8 mb-4">
                        <div class="card-custom p-4">
                            <h5 class="mb-4">Cart Items ({{ $cart->item_count }})</h5>

                            @foreach($cart->items as $item)
                                <div class="d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}"
                                    style="border-color: var(--border-color) !important;">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="rounded"
                                        style="width: 100px; height: 80px; object-fit: cover;">

                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                        <small class="text-secondary">{{ $item->product->category }}</small>
                                        <div class="mt-2">
                                            <span style="color: var(--accent-color); font-weight: 600;">
                                                Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column align-items-end gap-2">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                class="form-control form-control-custom text-center" style="width: 70px;">
                                            <button type="submit" class="btn btn-outline-custom btn-sm">
                                                <i class="bi bi-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="color: #ef4444;">
                                                <i class="bi bi-trash me-1"></i>Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card-custom p-4">
                            <h5 class="mb-4">Order Summary</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Subtotal</span>
                                <span>Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Tax</span>
                                <span>Rp 0</span>
                            </div>
                            <hr style="border-color: var(--border-color);">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold" style="color: var(--accent-color); font-size: 1.25rem;">
                                    Rp {{ number_format($cart->total, 0, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ route('orders.checkout') }}" class="btn btn-primary-custom w-100 py-2">
                                <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                            </a>

                            <a href="{{ route('products.index') }}" class="btn btn-outline-custom w-100 mt-2">
                                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection