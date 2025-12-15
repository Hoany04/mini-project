@extends('layouts.AdminLayout')

@section('content')
<div class="container mt-4 card">
    <h4 class="p-4">Product variations: {{ $product->name }}</h4>
    <div class="text-end">
        <a href="{{ route('admin.product_variants.create', $product->id) }}" class="btn btn-primary mb-3">+ Add a variant</a>
    </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>Variant name</th>
                <th>Value</th>
                <th>Additional price</th>
                <th>Inventory</th>
                <th>Act</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($variants as $v)
                <tr>
                    <td>{{ $v->variant_name }}</td>
                    <td>{{ $v->variant_value }}</td>
                    <td>{{ number_format($v->extra_price) }}₫</td>
                    <td>{{ $v->stock }}</td>
                    <td>
                        <a href="{{ route('admin.product_variants.edit', [$product->id, $v->id]) }}" class="btn btn-warning btn-sm">✏️</a>
                        <form action="{{ route('admin.product_variants.destroy', [$product->id, $v->id]) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this variant?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
</div>
@endsection
