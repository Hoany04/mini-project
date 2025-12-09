@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
    <div class="container mt-4 card">
        <h2 class="p-4">List Category</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.categorys.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Tìm theo tên..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.categorys.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="text-end mb-3">
            <a href="{{ route('admin.categorys.create') }}" class="btn btn-primary">+ Add new</a>
        </div>

        <!-- Bảng danh mục -->
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="5%">#</th>
                    <th>Category name</th>
                    <th>Parent category</th>
                    <th>Creator</th>
                    <th>Describe</th>
                    <th>Date created</th>
                    <th width="18%">Operation</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $key=>$item)
                    <tr class="text-center">
                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $key + 1 }}</td>
                        <td class="text-start fw-bold">{{ $item->name }}</td>
                        <td>{{ $item->parent?->name ?? 'Không có' }}</td>
                        <td>{{ $item->creator?->username ?? 'N/A' }}</td>
                        <td class="text-start">{{ Str::limit($item->description, 40) }}</td>
                        <td>{{ $item->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.categorys.edit', $item->id) }}" class="btn btn-sm btn-warning">✏️</a>
                            <form method="POST" action="{{ route('admin.categorys.destroy', $item->id) }}"
                                class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">There are no categories..</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
