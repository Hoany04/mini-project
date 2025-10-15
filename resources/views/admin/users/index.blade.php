@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4 card">
        <h2>List users</h2>

        <form method="get" action="{{ route('admin.users.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tim theo ten hoac email">
            </div>

            <div class="col-md-3">
                <select name="role_id" class="form-select" id="">
                    <option value="">--Role--</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : ''}}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Trạng thái --</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Lọc</button>
            </div>
        </form>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">+ Add user</a>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key=>$user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'Not available' }}</td>
                        <td>
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'secondary' : 'danger') }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
            <tr><td colspan="6" class="text-center text-muted">Không tìm thấy người dùng nào</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- {{ $users->withQueryString()->links() }} --}}
    </div>
@endsection