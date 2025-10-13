@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 col-md-6">
    <h3>Thêm người dùng mới</h3>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nhập lại mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role_id" class="form-select">
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="active">Kích hoạt</option>
                <option value="inactive">Ngưng hoạt động</option>
            </select>
        </div>

        <button class="btn btn-success w-100">Lưu</button>
    </form>
</div>
@endsection