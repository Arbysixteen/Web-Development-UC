@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="py-5">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"
                                    style="color: var(--accent-color);">Home</a></li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">Products</li>
                        </ol>
                    </nav>
                    <h1 class="section-title mb-1">All Products</h1>
                    <p class="text-secondary mb-0">Discover our collection of digital products and services</p>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg me-2"></i>Add new product
                </a>
            </div>

            <!-- Filter Section -->
            <div class="card-custom p-4 mb-5">
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="row g-3 align-items-end">
                        <!-- Search -->
                        <div class="col-md-3">
                            <label class="form-label text-secondary small">Search</label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" class="form-control form-control-custom"
                                    placeholder="Search by name or description..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="col-md-2">
                            <label class="form-label text-secondary small">Category</label>
                            <select name="category" class="form-select form-control-custom">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="col-md-2">
                            <label class="form-label text-secondary small">Min Price (Rp)</label>
                            <input type="number" name="min_price" class="form-control form-control-custom" placeholder="Min"
                                value="{{ request('min_price') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-secondary small">Max Price (Rp)</label>
                            <input type="number" name="max_price" class="form-control form-control-custom" placeholder="Max"
                                value="{{ request('max_price') }}">
                        </div>

                        <!-- Sort -->
                        <div class="col-md-2">
                            <label class="form-label text-secondary small">Sort By</label>
                            <select name="sort" class="form-select form-control-custom">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to
                                    High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High
                                    to Low</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular
                                </option>
                            </select>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="bi bi-funnel"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Active Filters & Reset -->
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                        <div class="mt-3 pt-3 border-top" style="border-color: var(--border-color) !important;">
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-custom">
                                <i class="bi bi-x-circle me-1"></i>Clear All Filters
                            </a>
                            @if(request('search'))
                                <span class="badge ms-2" style="background: var(--accent-color);">
                                    Search: {{ request('search') }}
                                </span>
                            @endif
                            @if(request('category'))
                                <span class="badge ms-2" style="background: var(--accent-color);">
                                    Category: {{ request('category') }}
                                </span>
                            @endif
                            @if(request('min_price') || request('max_price'))
                                <span class="badge ms-2" style="background: var(--accent-color);">
                                    Price: Rp {{ number_format(request('min_price', 0), 0, ',', '.') }} - Rp
                                    {{ number_format(request('max_price', 99999999), 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    @endif
                </form>
            </div>

            <!-- Products Grid - Display 20 products using Blade directives -->
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: var(--text-secondary);"></i>
                            <h4 class="mt-3">No Products Found</h4>
                            <p class="text-secondary">There are no products available at the moment.</p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary-custom">
                                <i class="bi bi-plus-lg me-1"></i>Add First Product
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Products Count Info -->
            @if($products->count() > 0)
                <div class="text-center mt-5">
                    <p class="text-secondary">
                        Showing <strong>{{ $products->firstItem() }}</strong> to <strong>{{ $products->lastItem() }}</strong>
                        of <strong>{{ $products->total() }}</strong> products
                    </p>
                </div>
            @endif

            <!-- Pagination -->
            @if($products->hasPages())
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if($products->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"
                                    style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                    <i class="bi bi-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                    style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-primary);">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <li class="page-item active">
                                    <span class="page-link" style="background: var(--accent-color); border-color: var(--accent-color);">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}"
                                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-primary);">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($products->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}"
                                    style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-primary);">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"
                                    style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                    <i class="bi bi-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </section>
@endsection