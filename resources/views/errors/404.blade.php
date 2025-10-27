@extends('layouts.ClientLayout')

@section('title', 'Trang không tồn tại')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center text-center py-12">
    <h1 class="text-6xl font-bold text-gray-800 mb-6">404</h1>
    <h2 class="text-2xl text-gray-600 mb-4">Trang bạn tìm kiếm không tồn tại</h2>
    <p class="text-gray-500 mb-8">
        Có thể đường dẫn bạn nhập đã sai, hoặc nội dung này đã bị xóa.
    </p>

    <a href="{{ route('client.home') }}" >
        <p>← Quay lại Trang Chủ</p>
    </a>
</div>
@endsection
