@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container mt-4 card">
    <h3 class="p-4">Order list</h3>

    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or email...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Status --</option>
                @foreach(['pending'=>'pending','paid'=>'paid','shipped'=>'shipped','completed'=>'completed','cancelled'=>'cancelled'] as $key => $label)
                    <option value="{{ $key }}" {{ request('status')==$key?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Total amount</th>
                <th>Discount code</th>
                <th>Status</th>
                <th>Date of booking</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key=>$order)
                <tr>
                    <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $key + 1 }}</td>
                    <td>{{ $order->user->username ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount) }}₫</td>
                    <td>{{ $order->coupon->code ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                @foreach(['pending','paid','shipped','completed','cancelled'] as $st)
                                    <option value="{{ $st }}" {{ $order->status==$st?'selected':'' }}>{{ ucfirst($st) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">👁️</a>
                        <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this order?')" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection
