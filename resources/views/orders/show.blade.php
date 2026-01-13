@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<section class="py-5">
    <div class="container py-4">
        <div class="mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}" class="text-decoration-none" style="color: var(--accent-color);">My Orders</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">{{ $order->order_number }}</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="section-title mb-1">Order Details</h1>
                    <p class="text-secondary mb-0">Order #{{ $order->order_number }}</p>
                </div>
                @php
                    $statusColors = [
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger'
                    ];
                    $statusColor = $statusColors[$order->status] ?? 'secondary';
                @endphp
                <span class="badge bg-{{ $statusColor }} text-capitalize fs-6 px-3 py-2">{{ $order->status }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card-custom p-4 mb-4">
                    <h5 class="mb-4"><i class="bi bi-box-seam me-2"></i>Order Items</h5>
                    
                    @foreach($order->items as $item)
                        <div class="d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-color: var(--border-color) !important;">
                            <img src="{{ $item->product->image ?? 'https://via.placeholder.com/100' }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="rounded" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                            
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $item->product_name }}</h6>
                                <small class="text-secondary">Quantity: {{ $item->quantity }}</small>
                                <div class="mt-2">
                                    <span style="color: var(--accent-color); font-weight: 600;">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-secondary"> x {{ $item->quantity }}</span>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <span class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-custom p-4">
                    <h5 class="mb-4"><i class="bi bi-truck me-2"></i>Shipping Information</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-secondary d-block mb-1">Address</small>
                            <p class="mb-0">{{ $order->shipping_address }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <small class="text-secondary d-block mb-1">City</small>
                            <p class="mb-0">{{ $order->city }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <small class="text-secondary d-block mb-1">Postal Code</small>
                            <p class="mb-0">{{ $order->postal_code }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-secondary d-block mb-1">Phone</small>
                            <p class="mb-0">{{ $order->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-secondary d-block mb-1">Payment Method</small>
                            <p class="mb-0 text-capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom p-4 mb-4">
                    <h5 class="mb-4">Order Summary</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Subtotal</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom" style="border-color: var(--border-color) !important;">
                        <span class="text-secondary">Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0">Total</h5>
                        <h5 class="mb-0" style="color: var(--accent-color);">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>

                <div class="card-custom p-4">
                    <h5 class="mb-3">Order Timeline</h5>
                    
                    <div class="d-flex gap-3 mb-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; background: var(--success-color);">
                                <i class="bi bi-check-lg text-white"></i>
                            </div>
                            <div style="width: 2px; height: 30px; background: var(--border-color);"></div>
                        </div>
                        <div>
                            <h6 class="mb-0">Order Placed</h6>
                            <small class="text-secondary">{{ $order->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>

                    @if($order->status != 'pending')
                        <div class="d-flex gap-3 mb-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px; background: {{ in_array($order->status, ['processing', 'completed']) ? 'var(--success-color)' : 'var(--border-color)' }};">
                                    <i class="bi bi-check-lg text-white"></i>
                                </div>
                                @if($order->status != 'cancelled')
                                    <div style="width: 2px; height: 30px; background: var(--border-color);"></div>
                                @endif
                            </div>
                            <div>
                                <h6 class="mb-0">Processing</h6>
                                <small class="text-secondary">{{ $order->updated_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                    @endif

                    @if($order->status == 'completed')
                        <div class="d-flex gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; background: var(--success-color);">
                                <i class="bi bi-check-lg text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Completed</h6>
                                <small class="text-secondary">{{ $order->updated_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                    @endif

                    @if($order->status == 'cancelled')
                        <div class="d-flex gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; background: #ef4444;">
                                <i class="bi bi-x-lg text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Cancelled</h6>
                                <small class="text-secondary">{{ $order->updated_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                    @endif
                </div>

                <a href="{{ route('orders.index') }}" class="btn btn-outline-custom w-100 mt-3">
                    <i class="bi bi-arrow-left me-2"></i>Back to Orders
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
