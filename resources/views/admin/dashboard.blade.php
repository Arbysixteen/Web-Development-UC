@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="py-5">
    <div class="container-fluid py-4">
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="section-title mb-1"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</h1>
                    <p class="text-secondary mb-0">Welcome back, {{ auth()->user()->name }}! Monitor your marketplace performance.</p>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg me-2"></i>Add Product
                </a>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-secondary d-block mb-1">Total Revenue</small>
                            <h3 class="mb-0" style="color: var(--accent-color);">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                            <small class="text-success"><i class="bi bi-arrow-up"></i> From completed orders</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; background: rgba(99, 102, 241, 0.1);">
                            <i class="bi bi-cash-stack" style="font-size: 1.5rem; color: var(--accent-color);"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-secondary d-block mb-1">Total Orders</small>
                            <h3 class="mb-0">{{ $totalOrders }}</h3>
                            <small class="text-warning"><i class="bi bi-clock"></i> {{ $pendingOrders }} pending</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; background: rgba(251, 191, 36, 0.1);">
                            <i class="bi bi-receipt" style="font-size: 1.5rem; color: #fbbf24;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-secondary d-block mb-1">Products</small>
                            <h3 class="mb-0">{{ $totalProducts }}</h3>
                            <small class="text-info"><i class="bi bi-box"></i> Active listings</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1);">
                            <i class="bi bi-box-seam" style="font-size: 1.5rem; color: #3b82f6;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-custom p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-secondary d-block mb-1">Customers</small>
                            <h3 class="mb-0">{{ $totalCustomers }}</h3>
                            <small class="text-success"><i class="bi bi-people"></i> Registered users</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; background: rgba(34, 197, 94, 0.1);">
                            <i class="bi bi-people" style="font-size: 1.5rem; color: #22c55e;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card-custom p-4">
                    <h5 class="mb-4"><i class="bi bi-graph-up me-2"></i>Monthly Revenue (2026)</h5>
                    <canvas id="revenueChart" height="80"></canvas>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom p-4 h-100">
                    <h5 class="mb-4"><i class="bi bi-pie-chart me-2"></i>Order Status</h5>
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Completed</span>
                                <span class="fw-bold" style="color: #22c55e;">{{ $completedOrders }}</span>
                            </div>
                            <div class="progress" style="height: 8px; background: var(--bg-tertiary);">
                                <div class="progress-bar" style="width: {{ $totalOrders > 0 ? ($completedOrders/$totalOrders)*100 : 0 }}%; background: #22c55e;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Pending</span>
                                <span class="fw-bold" style="color: #fbbf24;">{{ $pendingOrders }}</span>
                            </div>
                            <div class="progress" style="height: 8px; background: var(--bg-tertiary);">
                                <div class="progress-bar" style="width: {{ $totalOrders > 0 ? ($pendingOrders/$totalOrders)*100 : 0 }}%; background: #fbbf24;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>Top Products</h5>
                        <a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--accent-color);">
                            View All <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    @if($topProducts->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-secondary);"></i>
                            <p class="text-secondary mt-3">No sales data yet</p>
                        </div>
                    @else
                        @foreach($topProducts as $product)
                            <div class="d-flex align-items-center gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}" 
                                 style="border-color: var(--border-color) !important;">
                                <img src="{{ $product->image }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                    <small class="text-secondary">{{ $product->total_sold }} sold</small>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold" style="color: var(--accent-color);">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Orders</h5>
                        <a href="{{ route('admin.orders') }}" class="text-decoration-none" style="color: var(--accent-color);">
                            View All <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    @if($recentOrders->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-secondary);"></i>
                            <p class="text-secondary mt-3">No orders yet</p>
                        </div>
                    @else
                        @foreach($recentOrders as $order)
                            <div class="d-flex justify-content-between align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}" 
                                 style="border-color: var(--border-color) !important;">
                                <div>
                                    <h6 class="mb-1">{{ $order->order_number }}</h6>
                                    <small class="text-secondary">{{ $order->user->name }}</small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold mb-1">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'completed' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                        $statusColor = $statusColors[$order->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="card-custom p-4">
            <h5 class="mb-4"><i class="bi bi-lightning-charge me-2"></i>Quick Actions</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="{{ route('products.create') }}" class="btn btn-primary-custom w-100 py-3">
                        <i class="bi bi-plus-lg d-block mb-2" style="font-size: 1.5rem;"></i>
                        Add Product
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-custom w-100 py-3">
                        <i class="bi bi-list-check d-block mb-2" style="font-size: 1.5rem;"></i>
                        Manage Orders
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-custom w-100 py-3">
                        <i class="bi bi-grid d-block mb-2" style="font-size: 1.5rem;"></i>
                        View Products
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-custom w-100 py-3">
                        <i class="bi bi-shop d-block mb-2" style="font-size: 1.5rem;"></i>
                        Visit Store
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart');
const chartData = @json($chartData);

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Revenue (Rp)',
            data: chartData,
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#a0a0a0',
                    callback: function(value) {
                        return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                },
                grid: {
                    color: '#3d3d3d'
                }
            },
            x: {
                ticks: {
                    color: '#a0a0a0'
                },
                grid: {
                    color: '#3d3d3d'
                }
            }
        }
    }
});
</script>
@endpush