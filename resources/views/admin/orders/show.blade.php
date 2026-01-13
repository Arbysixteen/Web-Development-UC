@extends('layouts.app')

@section('title', 'Order Details - Admin')

@section('content')
<section class="py-5">
    <div class="container-fluid py-4">
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="section-title mb-1"><i class="bi bi-receipt me-2"></i>Order #{{ $order->order_number }}</h1>
                    <p class="text-secondary mb-0">Manage order details and status</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-custom">
                    <i class="bi bi-arrow-left me-2"></i>Back to Orders
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-custom p-4 mb-4">
                    <h5 class="mb-4"><i class="bi bi-box-seam me-2"></i>Order Items</h5>
                    
                    @foreach($order->items as $item)
                        <div class="d-flex gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}" 
                             style="border-color: var(--border-color) !important;">
                            <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}" 
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

                <div class="card-custom p-4 mb-4">
                    <h5 class="mb-4"><i class="bi bi-person me-2"></i>Customer Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-secondary d-block mb-1">Name</small>
                            <p class="mb-0">{{ $order->user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-secondary d-block mb-1">Email</small>
                            <p class="mb-0">{{ $order->user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-secondary d-block mb-1">Phone</small>
                            <p class="mb-0">{{ $order->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-custom p-4">
                    <h5 class="mb-4"><i class="bi bi-truck me-2"></i>Shipping Information</h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <small class="text-secondary d-block mb-1">Address</small>
                            <p class="mb-0">{{ $order->shipping_address }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small class="text-secondary d-block mb-1">City</small>
                            <p class="mb-0">{{ $order->city }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small class="text-secondary d-block mb-1">Postal Code</small>
                            <p class="mb-0">{{ $order->postal_code }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1">Payment Method</small>
                            <p class="mb-0 text-capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom p-4 mb-4">
                    <h5 class="mb-4">Update Order Status</h5>
                    
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <label class="form-label fw-semibold">Order Status</label>
                        <select name="status" class="form-control form-control-custom mb-3">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="bi bi-check-circle me-2"></i>Update Status
                        </button>
                    </form>

                    <form action="{{ route('admin.orders.update-payment', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="form-label fw-semibold">Payment Status</label>
                        <select name="payment_status" class="form-control form-control-custom mb-3">
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-cash me-2"></i>Update Payment
                        </button>
                    </form>
                </div>

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

                    @if($order->paid_at)
                        <div class="alert alert-success" style="background: rgba(34, 197, 94, 0.1); border-color: #22c55e; color: #22c55e;">
                            <i class="bi bi-check-circle me-2"></i>
                            Paid at {{ $order->paid_at->format('d M Y, H:i') }}
                        </div>
                    @endif
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
            </div>
        </div>
    </div>
</section>
@endsection
