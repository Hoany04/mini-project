@extends('layouts.AdminLayout')
@php
use App\Enums\PaymentMethodStatus;
@endphp
@section('content')
<div class="container card mt-4">
    <h4 class="p-4">Sửa phương thức thanh toán</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.payment-methods.update', $method->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $method->name) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                @foreach (PaymentMethodStatus::cases() as $status)
                    <option value="{{ $status->value }}"
                        {{ old('status', $method->status->value) == $status->value ? 'selected' : '' }}>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
    <div class="mt-3"></div>
</div>
@endsection
