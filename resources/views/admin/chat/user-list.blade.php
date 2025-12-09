@extends('layouts.AdminLayout')
@section('content')
    <div class="container mt-4 card">
    <h4 class="mb-3 p-4">List of Users to Chat</h4>

    <div class="card">
        <div class="card-body">

            @if($users->count() == 0)
                <p>No users.</p>
            @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>STT</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Chat</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $key => $user)
                    <tr class="align-middle text-center">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-success">Online</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.chat.show', $user->id) }}" class="btn btn-primary btn-sm">
                                Chat now →
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif

        </div>
    </div>
</div>
@endsection
