@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Thêm mã giảm giá</h4>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Mã code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code ?? '') }}">
                @error('code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        
            <div class="col-md-6 mb-3">
                <label class="form-label">Loại giảm giá</label>
                <select name="discount_type" class="form-control">
                    <option value="percent" {{ old('discount_type', $coupon->discount_type ?? '') == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                    <option value="fixed" {{ old('discount_type', $coupon->discount_type ?? '') == 'fixed' ? 'selected' : '' }}>Cố định (VNĐ)</option>
                </select>
            </div>
        
            <div class="col-md-4 mb-3">
                <label class="form-label">Giá trị giảm</label>
                <input type="number" name="discount_value" class="form-control" value="{{ old('discount_value', $coupon->discount_value ?? '') }}">
            </div>
        
            <div class="col-md-4 mb-3">
                <label class="form-label">Đơn tối thiểu</label>
                <input type="number" name="min_order_value" class="form-control" value="{{ old('min_order_value', $coupon->min_order_value ?? '') }}">
            </div>
        
            <div class="col-md-4 mb-3">
                <label class="form-label">Giảm tối đa</label>
                <input type="number" name="max_discount" class="form-control" value="{{ old('max_discount', $coupon->max_discount ?? '') }}">
            </div>
        
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày bắt đầu</label>
                <input type="datetime-local" name="start_date" class="form-control"
                    value="{{ old('start_date', isset($coupon->start_date) ? $coupon->start_date->format('Y-m-d\TH:i') : '') }}">
            </div>
        
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày kết thúc</label>
                <input type="datetime-local" name="end_date" class="form-control"
                    value="{{ old('end_date', isset($coupon->end_date) ? $coupon->end_date->format('Y-m-d\TH:i') : '') }}">
            </div>
        
            <div class="col-md-6 mb-3">
                <label class="form-label">Giới hạn sử dụng</label>
                <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
            </div>
        
            <div class="col-md-6 mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="active" {{ old('status', $coupon->status ?? '') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                    <option value="inactive" {{ old('status', $coupon->status ?? '') == 'inactive' ? 'selected' : '' }}>Vô hiệu</option>
                    <option value="expired" {{ old('status', $coupon->status ?? '') == 'expired' ? 'selected' : '' }}>Hết hạn</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
</div>
@endsection
