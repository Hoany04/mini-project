@extends('layouts.AdminLayout')

@section('content')
    <div class="container">
        <h4>Thêm phương thức thanh toán</h4>
        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="active">Kích hoạt</option>
                    <option value="inactive">Tạm ngừng</option>
                </select>
            </div>
            <button class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection