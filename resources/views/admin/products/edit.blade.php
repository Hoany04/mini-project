@extends('layouts.AdminLayout')
@php
use App\Enums\ProductStatus;
@endphp
@section('content')
    <div class="container mt-4 col-md-8 card">
        <h3 class="p-4">Cập nhật sản phẩm</h3>

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                        required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                        required>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tồn kho</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}"
                        required>
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        @foreach (ProductStatus::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Cập nhật sản phẩm</button>
        </form>

        <hr>
        <h5>Hình ảnh sản phẩm</h5>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.products.images.store', $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="images[]" multiple class="form-control" required>
            </div>
            <button class="btn btn-secondary">Thêm ảnh</button>
        </form>

        <div class="row mt-3">
            @foreach ($product->images as $img)
                <div class="col-md-3 text-center mb-3">
                    <div class="card">
                        {{-- <pre>{{ $img->image_url }}</pre> --}}
                        <img src="{{ asset('storage/' . $img->image_url) }}" class="card-img-top" alt="Ảnh sản phẩm">
                        <div class="card-body p-2">
                            @if ($img->is_main)
                                <span class="badge bg-success mb-2">Ảnh chính</span>
                            @endif
                            <form method="POST"
                                action="{{ route('admin.products.images.destroy', [$product->id, $img->id]) }}"
                                onsubmit="return confirm('Xóa ảnh này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-3"></div>
@endsection
