@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
    <section class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card-custom p-5 text-center">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                style="width: 100px; height: 100px; background: rgba(34, 197, 94, 0.1);">
                                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #22c55e;"></i>
                            </div>
                        </div>

                        <h2 class="mb-2">Payment Successful!</h2>
                        <p class="text-secondary mb-4">Thank you for your purchase</p>

                        <div class="p-4 rounded-3 mb-4" style="background: var(--bg-secondary);">
                            <div class="row g-3 text-start">
                                <div class="col-6">
                                    <small class="text-secondary d-block">Order Number</small>
                                    <span class="fw-bold">{{ $order->order_number }}</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-secondary d-block">Date</small>
                                    <span class="fw-bold">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-secondary d-block">Payment Status</small>
                                    <span class="badge" style="background: #22c55e;">PAID</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-secondary d-block">Total Amount</small>
                                    <span class="fw-bold" style="color: var(--accent-color);">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="text-start mb-4">
                            <h6 class="mb-3">Order Items</h6>
                            @foreach($order->items as $item)
                                <div class="d-flex justify-content-between py-2 {{ !$loop->last ? 'border-bottom' : '' }}"
                                    style="border-color: var(--border-color) !important;">
                                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="alert alert-success-custom mb-4">
                            <i class="bi bi-envelope-check me-2"></i>
                            Invoice has been sent to <strong>{{ auth()->user()->email }}</strong>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('products.index') }}" class="btn btn-primary-custom">
                                <i class="bi bi-grid me-2"></i>Continue Shopping
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-custom">
                                <i class="bi bi-house me-2"></i>Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection