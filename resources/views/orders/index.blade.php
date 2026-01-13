@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<section class="py-5">
    <div class="container py-4">
        <div class="mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">My Orders</li>
                </ol>
            </nav>
            <h1 class="section-title mb-1">My Orders</h1>
            <p class="text-secondary mb-0">Track and manage your orders</p>
        </div>

        @if($orders->isEmpty())
            <div class="card-custom p-5 text-center">
                <i class="bi bi-bag-x" style="font-size: 4rem; color: var(--text-secondary);"></i>
                <h4 class="mt-3">No orders yet</h4>
                <p class="text-secondary">Start shopping to create your first order.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary-custom">
                    <i class="bi bi-grid me-2"></i>Browse Products
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach($orders as $order)
                    <div class="col-12">
                        <div class="card-custom p-4">
                            <div class="row align-items-center">
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div>
                                        <small class="text-secondary d-block mb-1">Order Number</small>
                                        <span class="fw-bold">{{ $order->order_number }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div>
                                        <small class="text-secondary d-block mb-1">Date</small>
                                        <span>{{ $order->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div>
                                        <small class="text-secondary d-block mb-1">Total</small>
                                        <span class="fw-bold" style="color: var(--accent-color);">
                                            Rp {{ number_format($order->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div>
                                        <small class="text-secondary d-block mb-1">Status</small>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'processing' => 'info',
                                                'completed' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                            $statusColor = $statusColors[$order->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }} text-capitalize">{{ $order->status }}</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 mb-3 mb-md-0">
                                    <div>
                                        <small class="text-secondary d-block mb-1">Items</small>
                                        <span>{{ $order->items->count() }} product(s)</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 text-md-end">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-custom btn-sm">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
