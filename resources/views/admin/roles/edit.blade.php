@extends('layouts.AdminLayout')
@section('content')
    <div class="container mt-4 card">
        <h2 class="p-4">Assign permissions to roles: {{ $role->name }}</h2>

        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')

            @foreach ($permissions as $permission)
                <label for="">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                    {{ $permission->name }}
                </label>
                <br>
            @endforeach
            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        </form>
    </div>
@endsection
