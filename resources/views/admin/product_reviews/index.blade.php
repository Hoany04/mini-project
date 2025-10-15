@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h3 class="mb-3">Danh sách đánh giá sản phẩm</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Người dùng</th>
                <th>Đánh giá</th>
                <th>Bình luận</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $key => $review)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $review->product->name ?? 'N/A' }}</td>
                    <td>{{ $review->user->username ?? 'Ẩn danh' }}</td>
                    <td>{{ $review->rating }} ⭐</td>
                    <td>{{ $review->comment ?? 'Không có' }}</td>
                    <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.product_reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bạn chắc muốn xóa đánh giá này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reviews->links() }}
</div>
@endsection
