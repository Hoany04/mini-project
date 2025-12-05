@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('title', 'Sản phẩm đã xóa')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🗑️ Sản phẩm đã xóa mềm</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            ← Quay lại danh sách
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="alert alert-warning text-center">Không có sản phẩm nào trong thùng rác.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Người tạo</th>
                                <th>Ngày xóa</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->mainImage)
                                            <img src="{{ asset('storage/' . $product->mainImage->path) }}" 
                                                 alt="{{ $product->name }}" width="70" class="rounded">
                                        @else
                                            <img src="https://via.placeholder.com/70x70?text=No+Image" 
                                                 alt="No Image" class="rounded">
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'Chưa có' }}</td>
                                    <td>{{ $product->user->username ?? 'N/A' }}</td>
                                    <td>{{ $product->created_at->format('Y/m/d H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="bi bi-arrow-counterclockwise"></i> Khôi phục
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa vĩnh viễn sản phẩm này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Xóa vĩnh viễn
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
