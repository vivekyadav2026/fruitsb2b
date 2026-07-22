@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
        Sales & CRM / Orders
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Order Management</h1>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-outline">Export Excel</button>
        </div>
    </div>
</div>

<div class="card" style="padding: 0;">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Buyer</th>
                <th>Items</th>
                <th>Total Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="font-weight: 700; color: var(--primary);">ORD-{{ 10000 + $order->id }}</td>
                <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                <td>
                    <div style="font-weight: 600;">{{ $order->user->name ?? 'Unknown Buyer' }}</div>
                    <div style="font-size: 11px; color: var(--ink-soft);">{{ $order->delivery_or_pickup }}</div>
                </td>
                <td>{{ $order->items->count() }} items</td>
                <td style="font-weight: 700;">₹{{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</td>
                <td>
                    <span class="badge {{ $order->status == 'DELIVERED' ? 'badge-success' : ($order->status == 'DISPATCHED' ? 'badge-info' : 'badge-warning') }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline" style="padding: 4px 8px; font-size: 11px;">View Details</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px;">
                    <div style="color: var(--ink-soft); margin-bottom: 12px;">No orders found in the system.</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
