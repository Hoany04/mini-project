@extends('layouts.AdminLayout')

@section('content')
<div class="container card">
    <h4 class="p-4">Manage transportation methods</h4>

    <div class="text-end">
        <a href="{{ route('admin.shipping_methods.create') }}" class="btn btn-primary mb-3">+ Add</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Shipping fee</th>
                <th>Status</th>
                <th>Act</th>
            </tr>
        </thead>
        <tbody>
            @foreach($methods as $key => $m)
            <tr>
                <td>{{ ($methods->currentPage() - 1) * $methods->perPage() + $key + 1 }}</td>
                <td>{{ $m->name }}</td>
                <td>{{ number_format($m->fee, 0, ',', '.') }} đ</td>
                <td>
                    <button class="btn btn-sm toggle-status {{ $m->status == 'active' ? 'btn-success' : 'btn-secondary' }}" data-id="{{ $m->id }}">
                        {{ $m->status_label }}
                    </button>
                </td>
                <td>
                    <a href="{{ route('admin.shipping_methods.edit', $m->id) }}" class="btn btn-sm btn-warning">✏️</a>
                    <form action="{{ route('admin.shipping_methods.destroy', $m->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Confirm deletion?')">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $methods->links() }}
</div>

<script>
document.querySelectorAll('.toggle-status').forEach(btn => {
    btn.addEventListener('click', function() {
        fetch(`/admin/shipping_methods/${this.dataset.id}/toggle`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => location.reload());
    });
});
</script>
@endsection
