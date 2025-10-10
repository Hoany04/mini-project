@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 col-md-6">
    <h3>Sửa thông tin người dùng</h3>
    <form method="POST" action="">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="username" value="{{ $users->username }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $users->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role_id" class="form-select">
                @foreach($roles as $role)
                  <option value="{{ $role->id }}" {{ $users->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                  </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="active" {{ $users->status == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="inactive" {{ $users->status == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
            </select>
        </div>

        <button class="btn btn-primary w-100">Cập nhật</button>
    </form>
</div>
@endsection