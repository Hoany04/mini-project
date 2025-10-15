@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4 card">
        <h2>List Category</h2>

        <form method="GET" action="{{ route('admin.categorys.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Tìm theo tên..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Lọc</button>
                <a href="{{ route('admin.categorys.index') }}" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>

        <div class="text-end mb-3">
            <a href="{{ route('admin.categorys.create') }}" class="btn btn-success">+ Thêm mới</a>
        </div>

        <!-- Bảng danh mục -->
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="5%">#</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>Người tạo</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th width="18%">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $key=>$item)
                    <tr class="text-center">
                        <td>{{ $key+1 }}</td>
                        <td class="text-start fw-bold">{{ $item->name }}</td>
                        <td>{{ $item->parent?->name ?? 'Không có' }}</td>
                        <td>{{ $item->creator?->username ?? 'N/A' }}</td>
                        <td class="text-start">{{ Str::limit($item->description, 40) }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.categorys.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form method="POST" action="{{ route('admin.categorys.destroy', $item->id) }}"
                                class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa danh mục này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Không có danh mục nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
