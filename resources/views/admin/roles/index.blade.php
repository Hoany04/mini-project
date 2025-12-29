@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4 card">
        <h2 class="p-4">List of authorizations</h2>

        <div class="text-end">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">Add</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
                        <td>
                            {{-- {{ route('roles.edit', $role->id) }} --}}
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">✏️</a>
                            {{-- {{ route('roles.destroy', $role->id) }} --}}
                            {{-- <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('are you sure you want to delete?')">🗑️</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{-- {{ $roles->links() }} --}}
    </div>
@endsection
