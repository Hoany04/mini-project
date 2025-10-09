@extends('layouts.AdminLayout')

@section('content')
    <table class="table table-striped">
        <thead>
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
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listProducts as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->sold }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->average_rating }}</td>
                    <td>{{ $item->total_review }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection