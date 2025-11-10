@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="mb-3 card-title">Thêm biến thể cho sản phẩm: {{ $product->name }}</h3>

    <form action="{{ route('admin.product_variants.store', $product->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên biến thể</label>
            <input type="text" name="variant_name" class="form-control" value="{{ old('variant_name') }}">
            @error('variant_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Giá trị biến thể</label>
            <input type="text" name="variant_value" class="form-control" value="{{ old('variant_value') }}">
            @error('variant_value')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Giá cộng thêm</label>
            <input type="number" name="extra_price" class="form-control" value="{{ old('extra_price', 0) }}">
            @error('extra_price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tồn kho</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}">
            @error('stock')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.product_variants.index', $product->id) }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
