@extends('layouts.AdminLayout')
@php
use App\Enums\PaymentMethodStatus;
@endphp
@section('content')
    <div class="container card mt-4">
        <h4 class="p-4">Add payment methods</h4>
        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    @foreach (PaymentMethodStatus::cases() as $status)
                        <option value="{{ $status->value }}">
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        <div class="mt-3"></div>
    </div>
@endsection
