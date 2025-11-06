@extends('layouts.AdminLayout')

@section('content')
      <!-- Form Repeater -->
  <div class="col-12 card">
    {{-- <div class="card"> --}}
      <h5 class="card-header">Add Category</h5>
      <form method="POST" action="{{ route('admin.categorys.store') }}">
        @csrf
    
        <div class="mb-3">
          <label for="name" class="form-label">Tên danh mục</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
          @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    
        <div class="mb-3">
          <label for="description" class="form-label">Mô tả</label>
          <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
          @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    
        <div class="mb-3">
          <label for="parent_id" class="form-label">Danh mục cha</label>
          <select name="parent_id" id="parent_id" class="form-select">
            <option value="">-- Không có --</option>
            @foreach ($parentCategories as $parent)
              <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                {{ $parent->name }}
              </option>
            @endforeach
          </select>
        </div>
    
        <button type="submit" class="btn btn-primary w-100">Thêm mới</button>
      </form>
    {{-- </div> --}}
  </div>
  <!-- /Form Repeater -->
@endsection