@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="mb-3 p-4">Chỉnh sửa biến thể cho: {{ $product->name }}</h3>

    <form action="{{ route('admin.product_variants.update', [$product->id, $variant->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên biến thể</label>
            <input type="text" name="variant_name" class="form-control" value="{{ old('variant_name', $variant->variant_name) }}" >
            @error('variant_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Giá trị biến thể</label>
            <input type="text" name="variant_value" class="form-control" value="{{ old('variant_value', $variant->variant_value) }}" >
            @error('variant_value')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Giá cộng thêm</label>
            <input type="number" name="extra_price" class="form-control" value="{{ old('extra_price', $variant->extra_price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tồn kho</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $variant->stock) }}" required>
            @error('stock')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.product_variants.index', $product->id) }}" class="btn btn-secondary">Hủy</a>
    </form>
    <div class="mt-3"></div>
</div>
@endsection
