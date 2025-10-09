@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4">
        <h2>List Product</h2>

        <a href="" class="btn btn-primary mb-3">Add</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>User</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Sold</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listProducts as $key=>$item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->sold }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->average_rating }}</td>
                        <td>{{ $item->total_review }}</td>
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