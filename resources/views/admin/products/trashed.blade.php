@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('title', 'The product has been deleted.')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🗑️ The product has been gently erased.</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            ← Return to list
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="alert alert-warning text-center">There are no products in the trash can..</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Creator</th>
                                <th>Date deleted</th>
                                <th>Act</th>
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
                                    <td>{{ $product->category->name ?? 'Not yet' }}</td>
                                    <td>{{ $product->user->username ?? 'N/A' }}</td>
                                    <td>{{ $product->created_at->format('Y/m/d H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to permanently delete this product??')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Permanently delete
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
