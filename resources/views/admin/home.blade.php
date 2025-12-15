@extends('layouts.AdminLayout')
@vite(['resources/js/app.js'])
@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📊 Statistics & Reports</h3>

    <div class="row justify-content-center g-3">

        <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <h3 class="card-title mb-2">Congratulations <strong>{{ auth()->user()->username ?? 'User' }}</strong></h3>
                <span class="d-block mb-4 text-nowrap">Revenue (month {{ now()->format('m') }})</span>
                <h7 class="display-6 text-primary mb-2 pt-4 pb-1">{{ number_format($stats['total_revenue'], 0, ',', '.') }} ₫</h7>
              </div>
              <div class="card-body">
                <div class="row align-items-end">
                  <div class="col-6">

                    <small class="d-block mb-3">You have done 57.6% <br>more sales today.</small>

                    <a href="javascript:;" class="btn btn-sm btn-primary">View sales</a>
                  </div>
                  <div class="col-6">
                    <img src="{{ asset('assets/img/illustrations/prize-light.png') }}" width="140" height="150" class="rounded-start" alt="View Sales" data-app-light-img="illustrations/prize-light.png" data-app-dark-img="illustrations/prize-dark.html">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-12 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                  <img class="img-fluid w-60" src="{{ asset('assets/img/illustrations/sitting-girl-with-laptop-light.png') }}" alt="Card girl image" data-app-light-img="illustrations/sitting-girl-with-laptop-light.png" data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.html" />
                </div>
                <h4 class="mb-2 pb-1">Unprocessed orders (month {{ now()->format('m') }})</h4>
                <p class="big">{{ $stats['pending_orders'] ?? 0 }} Order</p>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary w-100">Deal with it immediately.</a>
              </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5>Doanh thu (tháng {{ now()->format('m') }})</h5>
                    <h2>{{ number_format($stats['total_revenue'], 0, ',', '.') }} ₫</h2>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row justify-content-center g-3 mt-2">
        <div class="col-lg-4 col-12">
            <div class="row">
              <!-- Statistics Cards -->
              <div class="col-6 col-md-3 col-lg-6 mb-4">
                <div class="card h-100">
                  <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                      <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-purchase-tag fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Product</span>
                    <h2 class="mb-0">{{ $stats['total_products'] ?? 0 }}</h2>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-3 col-lg-6 mb-4">
                <div class="card h-100">
                  <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                      <span class="avatar-initial rounded-circle bg-label-danger"><i class="bx bx-cart fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">Category</span>
                    <h2 class="mb-0">{{ $stats['total_categories'] ?? 0 }}</h2>

                  </div>
                </div>
              </div>
              <!--/ Statistics Cards -->
            </div>
          </div>
            <div class="col-md-2">
                <div class="card h-80">
                  <div class="card-body text-center">
                    <div class="avatar mx-auto mb-2">
                      <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-purchase-tag fs-4"></i></span>
                    </div>
                    <span class="d-block text-nowrap">User</span>
                    <h2 class="mb-0">{{ $stats['total_users'] ?? 0 }}</h2>
                  </div>
                </div>
            </div>
    </div>
</div>
@endsection
{{-- @section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.Echo) {
            window.Echo.channel('orders')
            .listen('.new-order', (e) => {
                console.log('🛒 Có đơn hàng mới:', e);
                alert('Có đơn hàng mới #' + e.order.id);
            });
        } else {
            console.error('Echo chưa load xong!');
        }
    });
</script>
@endsection --}}
