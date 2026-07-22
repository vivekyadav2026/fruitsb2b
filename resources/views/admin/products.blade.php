@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h1 class="page-title" style="margin: 0;">Manage Products</h1>
    <button class="btn btn-primary">+ Add New Commodity</button>
</div>

<div class="card" style="padding: 0;">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Commodity Name</th>
                <th>Category</th>
                <th>Live Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>#{{ $product->id }}</td>
                <td><img src="{{ asset($product->image_url) }}" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;"></td>
                <td style="font-weight: 600;">{{ $product->name }}<br><span style="font-size: 12px; color: var(--ink-soft); font-weight: 400;">Grade: {{ $product->grade }}</span></td>
                <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                <td style="font-weight: 700;">₹{{ number_format($product->price_per_unit, 2) }} / {{ $product->unit }}</td>
                <td>
                    @if($product->stock_status == 'IN_STOCK') <span style="color: var(--success); font-weight: 600;">In Stock</span>
                    @elseif($product->stock_status == 'LIMITED') <span style="color: var(--gold); font-weight: 600;">Limited</span>
                    @else <span style="color: var(--danger); font-weight: 600;">Out of Stock</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-outline" style="padding: 4px 8px;">Edit</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
