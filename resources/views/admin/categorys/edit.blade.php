@extends('layouts.AdminLayout')

@section('content')
    <div class="container mt-4 col-md-6 card">
        <h3 class="p-4">Update catalog</h3>

        <form method="POST" action="{{ route('admin.categorys.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Category name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Describe</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent category</label>
                <select name="parent_id" id="parent_id" class="form-select">
                    <option value="">-- Do not have --</option>
                    @foreach ($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="mt-3"></div>
    </div>
@endsection
