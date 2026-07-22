@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <a href="{{ route('admin.orders') }}" style="text-decoration:none; color:inherit;">Orders</a> &nbsp;/&nbsp; ORD-{{ 10000 + $order->id }}
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Order Details: ORD-{{ 10000 + $order->id }}</h1>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-outline">Download Invoice PDF</button>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                <select name="status" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 6px; border: 1px solid var(--line-strong); font-family: inherit; font-size: 13px; font-weight:600; background:var(--forest); color:white;">
                    <option value="PLACED" {{ $order->status == 'PLACED' ? 'selected' : '' }}>Mark as Placed</option>
                    <option value="CONFIRMED" {{ $order->status == 'CONFIRMED' ? 'selected' : '' }}>Mark as Confirmed</option>
                    <option value="PACKED" {{ $order->status == 'PACKED' ? 'selected' : '' }}>Mark as Packed</option>
                    <option value="DISPATCHED" {{ $order->status == 'DISPATCHED' ? 'selected' : '' }}>Mark as Dispatched</option>
                    <option value="DELIVERED" {{ $order->status == 'DELIVERED' ? 'selected' : '' }}>Mark as Delivered</option>
                </select>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div style="background: var(--success); color: white; padding: 12px 20px; border-radius: 6px; margin-bottom: 24px; font-size: 13.5px; font-weight: 600;">
    {{ session('success') }}
</div>
@endif

<div style="display:grid; grid-template-columns:2fr 1fr; gap:24px;">
    <div>
        <div class="card" style="padding:0;">
            <div class="card-header">Order Items</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="font-weight:600;">{{ $item->product->name ?? 'Unknown Product' }}</div>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td style="font-weight:700;">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div>
        <div class="card">
            <div class="card-header" style="border:none; padding-bottom:0;">Buyer Information</div>
            <div class="card-body">
                <div style="font-weight:700; font-size:16px; margin-bottom:4px;">{{ $order->user->name ?? 'Unknown Buyer' }}</div>
                <div style="color:var(--ink-soft); font-size:14px; margin-bottom:16px;">{{ $order->user->email ?? '' }}</div>
                <hr style="border:none; border-top:1px solid var(--line); margin-bottom:16px;">
                <div style="font-size:13px; font-weight:600; color:var(--ink-soft); margin-bottom:8px;">FULFILLMENT TYPE</div>
                <div style="font-size:15px; font-weight:600;">{{ $order->delivery_or_pickup }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
