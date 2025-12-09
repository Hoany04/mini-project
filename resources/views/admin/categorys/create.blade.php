@extends('layouts.AdminLayout')

@section('content')
      <!-- Form Repeater -->
  <div class="col-12 card">
    {{-- <div class="card"> --}}
      <h5 class="card-header p-4">Add Category</h5>
      <form method="POST" action="{{ route('admin.categorys.store') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Category name</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
          @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Describe</label>
          <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
          @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label for="parent_id" class="form-label">Parent category</label>
          <select name="parent_id" id="parent_id" class="form-select">
            <option value="">-- Do not have --</option>
            @foreach ($parentCategories as $parent)
              <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                {{ $parent->name }}
              </option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Add new</button>
      </form>
      <div class="mt-3"></div>
    {{-- </div> --}}
  </div>
  <!-- /Form Repeater -->
@endsection
