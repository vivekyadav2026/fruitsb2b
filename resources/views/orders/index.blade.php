@extends('layouts.storefront')

@section('content')

<style>
.ord-wrap{ padding:34px 0 70px; }
.ord-tabs{ display:flex; gap:8px; margin:22px 0 26px; }
.ord-tabs button{ border:1.5px solid var(--line-strong); background:var(--surface); padding:9px 18px; border-radius:999px; font-size:13.5px; cursor:pointer; color:var(--ink-soft); }
.ord-tabs button.active{ background:var(--forest); color:#fff; border-color:var(--forest); }

.order-card{ background:var(--surface); border:1px solid var(--line); border-radius:18px; padding:22px; margin-bottom:18px; box-shadow:var(--shadow-sm); }
.order-top{ display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.order-top .oid{ font-weight:700; font-size:15px; }
.order-top .odate{ font-size:12.5px; color:var(--ink-soft); }
.order-top .ototal{ font-weight:700; font-size:16px; text-align:right; }
.order-top .oitems{ font-size:12px; color:var(--ink-soft); text-align:right; }

.status-track{ display:flex; align-items:center; margin:18px 0; }
.status-step{ display:flex; flex-direction:column; align-items:center; flex:1; position:relative; }
.status-step .dot{ width:14px;height:14px;border-radius:50%; background:var(--line-strong); z-index:2; }
.status-step.done .dot{ background:var(--forest); }
.status-step.current .dot{ background:var(--gold); box-shadow:0 0 0 4px rgba(173,138,60,0.2); }
.status-step .lbl{ font-size:11px; color:var(--ink-soft); margin-top:8px; text-align:center; }
.status-step.done .lbl, .status-step.current .lbl{ color:var(--ink); font-weight:600; }
.status-line{ position:absolute; top:6px; left:-50%; width:100%; height:2px; background:var(--line-strong); z-index:1; }
.status-step.done .status-line{ background:var(--forest); }
.status-step:first-child .status-line{ display:none; }

.order-actions{ display:flex; gap:10px; margin-top:8px; }

@media (max-width: 600px) {
    .status-track {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        margin-left: 20px;
    }
    .status-step {
        flex-direction: row;
        align-items: center;
        gap: 16px;
        width: 100%;
    }
    .status-step .lbl {
        margin-top: 0;
        text-align: left;
    }
    .status-line {
        left: 6px;
        top: -20px;
        width: 2px;
        height: 20px;
    }
    .status-step:first-child .status-line {
        display: none;
    }
}
</style>

<div class="container ord-wrap">
  <span class="eyebrow">Order History</span>
  <h1 class="serif" style="font-size:32px;font-weight:600;">My Orders</h1>
  <div class="ord-tabs">
    <button class="active">All Orders</button>
  </div>

  @if(session('success'))
      <div class="mb-4" style="background:var(--success);color:#fff;padding:12px 20px;border-radius:var(--radius);font-weight:500;margin-bottom:20px;">
          {{ session('success') }}
      </div>
  @endif

  @if($orders->count() > 0)
      @foreach($orders as $order)
      <div class="order-card">
        <div class="order-top">
          <div><div class="oid">Order #{{ $order->id }}</div><div class="odate">Placed {{ $order->created_at->format('d M, h:i A') }}</div></div>
          <div><div class="ototal">₹{{ number_format($order->total_amount, 2) }}</div><div class="oitems">{{ $order->items->count() }} items</div></div>
        </div>
        
        <div class="status-track">
          @php
              $statusMap = [
                  'PENDING' => 1,
                  'CONFIRMED' => 2,
                  'PACKED' => 3,
                  'DISPATCHED' => 4,
                  'DELIVERED' => 5,
                  'CANCELLED' => 0
              ];
              $currentLevel = $statusMap[$order->status] ?? 1;
          @endphp
          
          <div class="status-step {{ $currentLevel >= 1 ? 'done' : '' }}"><div class="dot"></div><div class="lbl">Placed</div></div>
          <div class="status-step {{ $currentLevel >= 2 ? 'done' : '' }}"><div class="status-line"></div><div class="dot"></div><div class="lbl">Confirmed</div></div>
          <div class="status-step {{ $currentLevel >= 3 ? 'done' : '' }}"><div class="status-line"></div><div class="dot"></div><div class="lbl">Packed</div></div>
          <div class="status-step {{ $currentLevel >= 4 ? 'done' : '' }}"><div class="status-line"></div><div class="dot"></div><div class="lbl">Dispatched</div></div>
          <div class="status-step {{ $currentLevel >= 5 ? 'done' : '' }}"><div class="status-line"></div><div class="dot"></div><div class="lbl">Delivered</div></div>
        </div>

        <div style="font-size:13px; color:var(--ink-soft); margin-bottom:14px;">
            <strong>Type:</strong> {{ $order->delivery_or_pickup }} &nbsp;&bull;&nbsp;
            <strong>Payment:</strong> {{ $order->payment_method }}
        </div>

        <div class="order-actions">
          <a href="{{ route('orders.show', $order) }}" class="btn btn-ghost btn-sm" style="border:1px solid var(--line-strong);">View Details</a>
        </div>
      </div>
      @endforeach
  @else
      <div style="text-align:center; padding:60px 0; background:var(--surface); border-radius:18px; border:1px solid var(--line);">
          <div style="font-size:40px;margin-bottom:10px;">📦</div>
          <h3 style="font-size:18px;font-weight:600;">No orders found</h3>
          <p style="color:var(--ink-soft);margin-bottom:20px;">You haven't placed any orders yet.</p>
          <a href="{{ route('home') }}" class="btn btn-primary">Browse Catalog</a>
      </div>
  @endif

</div>

@endsection
