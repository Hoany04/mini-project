@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4 card">
        <h2 class="p-4">List Profile User</h2>

        <table class="table table-bordered">
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
                @foreach ($profiles as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->user->username ?? 'N/A' }}</td>
                        <td>{{ $p->phone ?? '—' }}</td>
                        <td>{{ $p->address ?? '—' }}</td>
                        <td>{{ $p->city ?? '—' }}</td>
                        <td>{{ $p->country ?? '—' }}</td>
                        <td>
                            @if ($p->avatar)
                                <img src="{{ asset('storage/' . $p->avatar) }}" width="50" height="50"
                                    class="rounded-circle" alt="">
                            @else
                                <span>—</span>
                            @endif
                        </td>
                        <td>
                            <a href="btn btn-sm btn-waring">✏️</a>
                            <a href="btn btn-sm btn-danger">🗑️</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $profiles->links() }}
    </div>
@endsection
