@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container-fluid">
    <h3>Nhật ký truy cập / thay đổi</h3>

    <form class="row g-2 mb-3" method="GET">
        <div class="col-auto">
            <input type="text" name="table_name" value="{{ request('table_name') }}" class="form-control" placeholder="table_name">
        </div>
        <div class="col-auto">
            <input type="text" name="user_id" value="{{ request('user_id') }}" class="form-control" placeholder="user_id">
        </div>
        <div class="col-auto">
            <select name="action" class="form-select">
                <option value="">-- action --</option>
                <option value="create" {{ request('action')=='create'?'selected':'' }}>create</option>
                <option value="update" {{ request('action')=='update'?'selected':'' }}>update</option>
                <option value="delete" {{ request('action')=='delete'?'selected':'' }}>delete</option>
            </select>
        </div>
        <div class="col-auto">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control">
        </div>
        <div class="col-auto">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Lọc</button>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
                <th>Table</th>
                <th>Record</th>
                <th>Old Data</th>
                <th>New Data</th>
                <th>At</th>
            </tr>
        </thead>
        <tbody>
        @foreach($logs as $key=>$log)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $log->user->username ?? 'System' }} ({{ $log->user_id }})</td>
                <td><span class="badge bg-info text-dark">{{ $log->action }}</span></td>
                <td>{{ $log->table_name }}</td>
                <td>{{ $log->record_id }}</td>
                <td><pre style="max-width:300px;white-space:pre-wrap;">{{ json_encode($log->old_data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) }}</pre></td>
                <td><pre style="max-width:300px;white-space:pre-wrap;">{{ json_encode($log->new_data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) }}</pre></td>
                <td>{{ Carbon::parse($log->created_at)->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $logs->withQueryString()->links() }}
</div>
@endsection
