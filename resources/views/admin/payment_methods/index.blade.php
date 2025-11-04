@extends('layouts.AdminLayout')

@section('content')
<h4>Phương thức thanh toán</h4>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
<a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary mb-3">
    + Thêm phương thức
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($methods as $key=>$method)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $method->name }}</td>
            <td>
                <span class="badge bg-{{ $method->status === 'active' ? 'success' : 'secondary' }}">
                    {{ $method->status === 'active' ? 'Kích hoạt' : 'Tạm ngừng' }}
                </span>
            </td>            
            <td>
                <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-warning btn-sm">Sửa</a>

                <form action="{{ route('admin.payment-methods.delete', $method->id) }}"
                      method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Chắc chắn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $methods->links() }}
@endsection
