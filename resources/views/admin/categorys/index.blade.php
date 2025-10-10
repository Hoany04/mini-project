@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4">
        <h2>List Category</h2>

        <a href="{{ route('admin.categorys.create') }}" class="btn btn-primary mb-3">Add</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Parent</th>
                    <th>Created_by</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorys as $key=>$category)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->parent_id }}</td>
                        <td>{{ $category->role->name ?? 'Not available'}}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-warning">Edit</a>
                            <form action="" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection