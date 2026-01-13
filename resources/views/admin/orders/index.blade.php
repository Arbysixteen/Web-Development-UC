@extends('layouts.app')

@section('title', 'Manage Orders - Admin')

@section('content')
<section class="py-5">
    <div class="container-fluid py-4">
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="section-title mb-1"><i class="bi bi-list-check me-2"></i>Manage Orders</h1>
                    <p class="text-secondary mb-0">View and manage all customer orders</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-custom">
                    <i class="bi bi-speedometer2 me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>

        <div class="card-custom p-4 mb-4">
            <form method="GET" action="{{ route('admin.orders') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-custom" 
                           placeholder="Search by order number, customer name or email..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control form-control-custom">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="bi bi-search me-2"></i>Filter
                    </button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-custom w-100">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        @if($orders->isEmpty())
            <div class="card-custom p-5 text-center">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--text-secondary);"></i>
                <h4 class="mt-3">No orders found</h4>
                <p class="text-secondary">Try adjusting your filters</p>
            </div>
        @else
            <div class="card-custom p-4">
                <div class="table-responsive">
                    <table class="table table-dark table-hover" style="background: transparent;">
                        <thead>
                            <tr style="border-color: var(--border-color);">
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr style="border-color: var(--border-color);">
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>
                                        <div>{{ $order->user->name }}</div>
                                        <small class="text-secondary">{{ $order->user->email }}</small>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $order->items->count() }} item(s)</td>
                                    <td><strong style="color: var(--accent-color);">Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                                    <td>
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
                                    </td>
                                    <td>
                                        @php
                                            $paymentColors = [
                                                'unpaid' => 'danger',
                                                'paid' => 'success',
                                                'failed' => 'danger'
                                            ];
                                            $paymentColor = $paymentColors[$order->payment_status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $paymentColor }} text-capitalize">{{ $order->payment_status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-custom">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
