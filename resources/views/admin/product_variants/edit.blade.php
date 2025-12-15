@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="mb-3 p-4">Edit the variant for: {{ $product->name }}</h3>

    <form action="{{ route('admin.product_variants.update', [$product->id, $variant->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Variant name</label>
            <input type="text" name="variant_name" class="form-control" value="{{ old('variant_name', $variant->variant_name) }}" >
            @error('variant_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Variant values</label>
            <input type="text" name="variant_value" class="form-control" value="{{ old('variant_value', $variant->variant_value) }}" >
            @error('variant_value')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Additional price</label>
            <input type="number" name="extra_price" class="form-control" value="{{ old('extra_price', $variant->extra_price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Inventory</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $variant->stock) }}" required>
            @error('stock')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.product_variants.index', $product->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
    <div class="mt-3"></div>
</div>
@endsection
