@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3 p-4">✏️ Cập nhật phương thức vận chuyển</h4>

    <form action="{{ route('admin.shipping_methods.update', $method->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên phương thức <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $method->name) }}" class="form-control" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $method->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fee" class="form-label">Phí vận chuyển (VNĐ) <span class="text-danger">*</span></label>
            <input type="number" name="fee" id="fee" min="0" step="1000" class="form-control"
                   value="{{ old('fee', $method->fee) }}" required>
            @error('fee')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-select">
                <option value="active" {{ old('status', $method->status) === 'active' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="inactive" {{ old('status', $method->status) === 'inactive' ? 'selected' : '' }}>Tạm ngừng</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('admin.shipping_methods.index') }}" class="btn btn-secondary">← Quay lại</a>
            <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        </div>
    </form>
</div>
@endsection
