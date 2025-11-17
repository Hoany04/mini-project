@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 col-md-6 card">
    <h3 class="p-4">Sửa thông tin người dùng</h3>
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="username" value="{{ $user->username }}" class="form-control" required>
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role_id" class="form-select">
                @foreach($roles as $role)
                  <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                  </option>
                @endforeach
            </select>
            @error('role_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
    </form>
</div>
@endsection
