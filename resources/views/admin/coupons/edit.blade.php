@extends('layouts.AdminLayout')
@php
use App\Enums\CouponStatus;
@endphp
@section('content')
<div class="container mt-4 card">
    <h4 class="mb-3 p-4">Edit Coupon</h4>

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code ?? '') }}">
                @error('code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Type of discount</label>
                <select name="discount_type" class="form-control">
                    <option value="percent" {{ old('discount_type', $coupon->discount_type ?? '') == 'percent' ? 'selected' : '' }}>Percent (%)</option>
                    <option value="fixed" {{ old('discount_type', $coupon->discount_type ?? '') == 'fixed' ? 'selected' : '' }}>Permanent (VNĐ)</option>
                </select>
                @error('discount_type') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Value decrease</label>
                <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value', $coupon->discount_value ?? '') }}">
                @error('discount_value') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Minimum order</label>
                <input type="number" name="min_order_value" class="form-control" value="{{ old('min_order_value', $coupon->min_order_value ?? '') }}">
                @error('min_order_value') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Minimize</label>
                <input type="number" name="max_discount" class="form-control" value="{{ old('max_discount', $coupon->max_discount ?? '') }}">
                @error('max_discount') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Start Date</label>
                <input type="datetime-local" name="start_date" class="form-control"
                    value="{{ old('start_date', isset($coupon->start_date) ? $coupon->start_date->format('Y-m-d\TH:i') : '') }}">
                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">End Date</label>
                <input type="datetime-local" name="end_date" class="form-control"
                    value="{{ old('end_date', isset($coupon->end_date) ? $coupon->end_date->format('Y-m-d\TH:i') : '') }}">
                    @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Usage limit</label>
                <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
                @error('usage_limit') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    @foreach (CouponStatus::cases() as $status)
                        <option value="{{ $status->value }}"
                            {{ old('status', $coupon->status ?? '') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <div class="mt-3">
    </form>
</div>
@endsection
