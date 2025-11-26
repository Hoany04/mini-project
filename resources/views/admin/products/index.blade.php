@extends('layouts.AdminLayout')
@php
use App\Enums\ProductStatus;
@endphp

@section('content')
    <div class="container mt-5 card">
        <h2 class="p-4">List Product</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Tìm theo tên..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">-- Danh mục --</option>
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Trạng thái --</option>
                    @foreach (ProductStatus::cases() as $status)
                        <option value="{{ $status->value }}"
                            {{ request('status') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Lọc</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>
        <div class="text-end mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Thêm mới</a>
        </div>
        <div class="text-end mb3">
            <a href="{{ route('admin.products.trashed') }}" class="btn btn-outline-danger">
                🗑️ Thùng rác
            </a>
        </div>
        <!-- Bảng sản phẩm -->
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Đã bán</th>
                    <th>Đánh giá TB</th>
                    <th>Trạng thái</th>
                    <th>Người tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="text-center">
                        <td>{{ $product->id }}</td>
                        <td class="text-start">{{ $product->name }}</td>
                        <td>{{ $product->category?->name ?? 'Không có' }}</td>
                        <td>
                            @if($product->mainImage)
                              <img src="{{ asset('storage/' . $product->mainImage->image_url) }}"
                                   alt="Ảnh sản phẩm"
                                   width="70" height="70"
                                   class="rounded border">
                            @else
                              <img src="https://via.placeholder.com/70x70?text=No+Image"
                                   alt="Không có ảnh"
                                   width="70" height="70"
                                   class="rounded border">
                            @endif
                          </td>

                        <td>{{ number_format($product->price, 0, ',', '.') }}₫</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->sold }}</td>
                        <td>{{ number_format($product->average_rating, 2) }}</td>
                        <td>
                             <span class="badge bg-{{ $product->status_enum->badgeColor() }}">
                                {{ $product->status_enum->label() }}
                            </span>
                        </td>
                        <td>{{ $product->user?->username ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.product_variants.index', $product->id) }}" class="btn btn-sm btn-info">
                                👁️
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-sm btn-warning">✏️</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">Không có sản phẩm nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
