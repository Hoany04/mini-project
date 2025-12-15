@extends('layouts.AdminLayout')
@php
use App\Enums\UserStatus;
@endphp

@section('content')
    <div class="container mt-4 card">
        <h2 class="p-4">List users</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        {{-- @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}


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
                    <option value="">-- Status --</option>
                    @foreach (UserStatus::cases() as $status)
                        <option value="{{ $status->value }}"
                            {{ request('status') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
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
                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'Not available' }}</td>
                        <td>
                            <span class="badge bg-{{ $user->status->badgeColor() }}">
                                {{ $user->status->label() }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">✏️</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty
            <tr><td colspan="6" class="text-center text-muted">No users found</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endsection
