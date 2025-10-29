@extends('layouts.AdminLayout')

@section('content')
<div class="container">
    <h4>Thêm phương thức vận chuyển</h4>
    <form action="{{ route('admin.shipping_methods.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Phí vận chuyển</label>
            <input type="number" name="fee" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="active">Kích hoạt</option>
                <option value="inactive">Tạm ngừng</option>
            </select>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.shipping_methods.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
