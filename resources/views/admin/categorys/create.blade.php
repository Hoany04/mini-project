@extends('layouts.AdminLayout')

@section('content')
      <!-- Form Repeater -->
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">Add Category</h5>
      <div class="card-body">

        <form class="{{ route('admin.categorys.store') }}" method="post">
            @csrf
          <div data-repeater-list="group-a">
            <div data-repeater-item>
              <div class="row">
                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                  <label class="form-label" for="name">Category Name</label>
                  <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="CategoryName" />
                  @error('name')
                        <p>{{ $message }}</p> 
                   @enderror
                </div>
                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                  <label class="form-label" for="description">Description</label>
                  <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                  <label class="form-label" for="form-repeater-1-3">Parent_id</label>
                  <select id="form-repeater-1-3" class="form-select">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                  <label class="form-label" for="form-repeater-1-4">Created_by</label>
                  <select id="form-repeater-1-4" class="form-select">
                    <option value="Designer">Designer</option>
                    <option value="Developer">Developer</option>
                    <option value="Tester">Tester</option>
                    <option value="Manager">Manager</option>
                  </select>
                </div>
                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                  <button class="btn btn-label-danger mt-4" data-repeater-delete>
                    <i class="bx bx-x me-1"></i>
                    <span class="align-middle">Delete</span>
                  </button>
                </div>
              </div>
              <hr>
            </div>
          </div>
          <div class="mb-0">
            <button class="btn btn-primary" data-repeater-create>
              <i class="bx bx-plus me-1"></i>
              <span class="align-middle">Add</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Form Repeater -->
@endsection