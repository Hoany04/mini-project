@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h4 class="mb-3 p-4">✏️ Update shipping methods</h4>

    <form action="{{ route('admin.shipping_methods.update', $method->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Method name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $method->name) }}" class="form-control" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $method->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fee" class="form-label">Shipping fee (VNĐ) <span class="text-danger">*</span></label>
            <input type="number" name="fee" id="fee" min="0" step="1000" class="form-control"
                   value="{{ old('fee', $method->fee) }}" required>
            @error('fee')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="active" {{ old('status', $method->status) === 'active' ? 'selected' : '' }}>Actctive</option>
                <option value="inactive" {{ old('status', $method->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('admin.shipping_methods.index') }}" class="btn btn-secondary">← Come back</a>
            <button type="submit" class="btn btn-primary">💾 Update</button>
        </div>
    </form>
    <div class="mt-3"></div>
</div>
@endsection
