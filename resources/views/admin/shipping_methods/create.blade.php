@extends('layouts.AdminLayout')

@section('content')
<div class="container card">
    <h4 class="p-4">Add a shipping method</h4>
    <form action="{{ route('admin.shipping_methods.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Shipping fee</label>
            <input type="number" name="fee" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.shipping_methods.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    <div class="mt-3"></div>
</div>
@endsection
