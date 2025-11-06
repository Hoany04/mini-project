@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4 col-md-8 card">
        <h3>Thêm sản phẩm mới</h3>

        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select" >
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $cate)
                            <option value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }}>
                                {{ $cate->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tồn kho</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" >
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" >
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động
                        </option>
                        <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Hết hàng
                        </option>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Thêm sản phẩm</button>
        </form>
    </div>
@endsection
