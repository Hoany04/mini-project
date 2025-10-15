@extends('layouts.AdminLayout')

@section('content')
    <h2>List Profile User</h2>

    <table class="table table-bordered card">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>User</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Avatar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $key=>$p)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $p->user->username ?? 'N/A' }}</td>
                    <td>{{ $p->phone ?? '—' }}</td>
                    <td>{{ $p->address ?? '—' }}</td>
                    <td>{{ $p->city ?? '—' }}</td>
                    <td>{{ $p->country ?? '—' }}</td>
                    <td>
                        @if ($p->avatar)
                            <img src="{{ asset('storage/' . $p->avatar) }}" width="50" height="50" class="rounded-circle" alt="">
                        @else
                            <span>—</span>
                        @endif
                    </td>
                    <td>
                        <a href="btn btn-sm btn-waring">Edit</a>
                        <a href="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection