@extends('layouts.AdminLayout')
@php
use App\Enums\ProductStatus;
@endphp
@section('content')
    <div class="container mt-4 col-md-8 card">
        <h3 class="p-4">Add new products</h3>

        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" >
                        <option value="">-- Select category --</option>
                        @foreach ($categories as $cate)
                            <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                                {{ $cate->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Inventory</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" >
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" >
                        @foreach (ProductStatus::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Product</button>
        </form>
        <div class="mt-3"></div>
    </div>
@endsection
