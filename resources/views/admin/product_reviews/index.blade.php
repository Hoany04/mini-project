@extends('layouts.AdminLayout')
<?php
use Carbon\Carbon;
?>
@section('content')
<div class="container mt-4 card">
    <h3 class="mb-3 p-4">Product review list</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Client</th>
                <th>Evaluate</th>
                <th>Comment</th>
                <th>Creation date</th>
                <th>Show/Hide</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $key => $review)
                <tr>
                    <td>{{ ($reviews->currentPage() - 1) * $reviews->perPage() + $key + 1 }}</td>
                    <td>{{ $review->product->name ?? 'N/A' }}</td>
                    <td>{{ $review->user->username ?? 'Anonymous' }}</td>
                    <td>{{ $review->rating }} ⭐</td>
                    <td>{{ $review->comment ?? 'Do not have' }}</td>
                    <td>{{ $review->created_at->format('Y/m/d H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.product_reviews.toggle', $review->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $review->is_visible ? 'btn-success' : 'btn-secondary' }}">
                                {{ $review->is_visible ? '👁️' : '🙈' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.product_reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('You probably want to delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reviews->links() }}
</div>
@endsection
