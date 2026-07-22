@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
        Catalog & Inventory / Products
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Manage Products</h1>
        <div style="display:flex; gap:12px;">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Commodity</a>
        </div>
    </div>
</div>

@if(session('success'))
<div style="background: var(--success); color: white; padding: 12px 20px; border-radius: 6px; margin-bottom: 24px; font-size: 13.5px; font-weight: 600;">
    {{ session('success') }}
</div>
@endif

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
            @forelse($products as $product)
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
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline" style="padding: 4px 8px; font-size:11px;">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this commodity?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline" style="padding: 4px 8px; font-size:11px; color:var(--danger); border-color:var(--danger);">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: var(--ink-soft);">
                    No products found in the catalog.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
