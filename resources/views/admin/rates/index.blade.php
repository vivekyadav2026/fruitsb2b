@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
        Catalog & Inventory / Today's Mandi Rates
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 class="page-title">Today's Mandi Rates</h1>
            <div style="font-size: 13px; color: var(--ink-soft); margin-top: 4px;">Update all prices rapidly. Last updated {{ now()->format('d M, Y h:i A') }}</div>
        </div>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-outline" type="button" onclick="document.getElementById('rates-form').reset()">Reset Changes</button>
            <button class="btn btn-primary" type="submit" form="rates-form">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                Publish All Rates
            </button>
        </div>
    </div>
</div>

@if(session('success'))
<div style="background: var(--success); color: white; padding: 12px 20px; border-radius: 6px; margin-bottom: 24px; font-size: 13.5px; font-weight: 600;">
    {{ session('success') }}
</div>
@endif

<div class="card" style="padding: 0;">
    <form id="rates-form" action="{{ route('admin.rates.update') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Commodity</th>
                    <th>Current Price</th>
                    <th>New Price (₹)</th>
                    <th>Trend</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div style="font-weight: 600;">{{ $product->name }}</div>
                        <div style="font-size: 12px; color: var(--ink-soft);">Unit: {{ $product->unit }}</div>
                    </td>
                    <td style="font-weight: 600; color: var(--ink-soft);">₹{{ number_format($product->price_per_unit, 2) }}</td>
                    <td>
                        <input type="number" step="0.01" name="prices[{{ $product->id }}]" value="{{ $product->price_per_unit }}" style="width: 120px; padding: 8px 12px; border-radius: 6px; border: 1px solid var(--line-strong); font-family: inherit; font-size: 14px; font-weight: 600;">
                    </td>
                    <td>
                        <select name="trends[{{ $product->id }}]" style="padding: 8px 12px; border-radius: 6px; border: 1px solid var(--line-strong); font-family: inherit; font-size: 13px;">
                            <option value="STABLE" {{ $product->price_trend_direction == 'STABLE' ? 'selected' : '' }}>Stable</option>
                            <option value="UP" {{ $product->price_trend_direction == 'UP' ? 'selected' : '' }}>Upward</option>
                            <option value="DOWN" {{ $product->price_trend_direction == 'DOWN' ? 'selected' : '' }}>Downward</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.products') }}" style="color: var(--primary); text-decoration: none; font-size: 12px; font-weight: 600;">Edit Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection
