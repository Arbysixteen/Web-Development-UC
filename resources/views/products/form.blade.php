@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="py-5">
    <div class="container py-4">
        <!-- Page Header -->
        <div class="mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--accent-color);">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--accent-color);">Products</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
            <h1 class="section-title mb-1">{{ $title }}</h1>
            <p class="text-secondary mb-0">
                @if($product)
                    Update your product information
                @else
                    Fill in the details to add a new product
                @endif
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-custom p-4 p-md-5">
                    <form action="{{ $action }}" method="{{ $method }}">
                        @csrf
                        
                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-tag me-1"></i>Product Name
                            </label>
                            <input type="text" 
                                   class="form-control form-control-custom @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $product->name ?? '') }}"
                                   placeholder="Enter product name"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-secondary">Give your product a clear and descriptive name</small>
                        </div>

                        <!-- Description Textarea -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="bi bi-text-paragraph me-1"></i>Description
                            </label>
                            <textarea class="form-control form-control-custom @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5"
                                      placeholder="Describe your product in detail..."
                                      required>{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-secondary">Provide a detailed description of your product or service</small>
                        </div>

                        <!-- Price Input -->
                        <div class="mb-4">
                            <label for="price" class="form-label fw-semibold">
                                <i class="bi bi-currency-dollar me-1"></i>Price (IDR)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                    Rp
                                </span>
                                <input type="number" 
                                       class="form-control form-control-custom @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $product->price ?? '') }}"
                                       placeholder="0"
                                       min="0"
                                       step="1000"
                                       required>
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-secondary">Set a competitive price for your product</small>
                        </div>

                        <!-- Category Select (Optional Enhancement) -->
                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">
                                <i class="bi bi-folder me-1"></i>Category
                            </label>
                            <select class="form-select form-control-custom" id="category" name="category">
                                <option value="">Select a category</option>
                                <option value="frontend" {{ old('category') == 'frontend' ? 'selected' : '' }}>Frontend Development</option>
                                <option value="backend" {{ old('category') == 'backend' ? 'selected' : '' }}>Backend Development</option>
                                <option value="fullstack" {{ old('category') == 'fullstack' ? 'selected' : '' }}>Fullstack Development</option>
                                <option value="template" {{ old('category') == 'template' ? 'selected' : '' }}>Template</option>
                                <option value="plugin" {{ old('category') == 'plugin' ? 'selected' : '' }}>Plugin</option>
                                <option value="ebook" {{ old('category') == 'ebook' ? 'selected' : '' }}>E-Book</option>
                            </select>
                            <small class="text-secondary">Choose the most relevant category for your product</small>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3 pt-4 border-top" style="border-color: var(--border-color) !important;">
                            <button type="submit" class="btn btn-primary-custom px-4">
                                <i class="bi bi-check-lg me-1"></i>
                                @if($product)
                                    Update Product
                                @else
                                    Submit
                                @endif
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-custom px-4">
                                <i class="bi bi-x-lg me-1"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Form Tips -->
                <div class="card-custom p-4 mt-4">
                    <h6 class="mb-3"><i class="bi bi-lightbulb me-2" style="color: var(--accent-color);"></i>Tips for a Great Product Listing</h6>
                    <ul class="mb-0 text-secondary" style="padding-left: 1.25rem;">
                        <li class="mb-2">Use a clear and descriptive product name</li>
                        <li class="mb-2">Include all features and benefits in the description</li>
                        <li class="mb-2">Set a competitive but fair price</li>
                        <li>Choose the most appropriate category</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
