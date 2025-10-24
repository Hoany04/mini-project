@extends('layouts.ClientLayout')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Cập nhật hồ sơ cá nhân</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.pages.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" name="address" id="address" value="{{ old('address', $profile->address) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Thành phố</label>
            <input type="text" name="city" id="city" value="{{ old('city', $profile->city) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Quốc gia</label>
            <input type="text" name="country" id="country" value="{{ old('country', $profile->country) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Ảnh đại diện</label>
            <input type="file" name="avatar" id="avatar" class="form-control">
            @if($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" width="80" class="mt-2 rounded-circle">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>
@endsection
