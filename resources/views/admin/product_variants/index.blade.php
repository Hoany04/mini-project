@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h4>Biến thể sản phẩm: {{ $product->name }}</h4>
    <a href="{{ route('admin.product_variants.create', $product->id) }}" class="btn btn-primary mb-3">+ Thêm biến thể</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên biến thể</th>
                <th>Giá trị</th>
                <th>Giá cộng thêm</th>
                <th>Tồn kho</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variants as $v)
                <tr>
                    <td>{{ $v->variant_name }}</td>
                    <td>{{ $v->variant_value }}</td>
                    <td>{{ number_format($v->extra_price) }}₫</td>
                    <td>{{ $v->stock }}</td>
                    <td>
                        <a href="{{ route('admin.product_variants.edit', [$product->id, $v->id]) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.product_variants.destroy', [$product->id, $v->id]) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa biến thể này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
