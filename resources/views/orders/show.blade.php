@extends('layouts.storefront')

@section('content')


<style>
.ord-wrap{ padding:34px 0 70px; }
.order-card{ background:var(--surface); border:1px solid var(--line); border-radius:18px; padding:22px; margin-bottom:18px; box-shadow:var(--shadow-sm); }
.order-top{ display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
.order-top .oid{ font-weight:700; font-size:15px; }
.order-top .odate{ font-size:12.5px; color:var(--ink-soft); }

.status-track{ display:flex; align-items:center; margin:24px 0; }
.status-step{ display:flex; flex-direction:column; align-items:center; flex:1; position:relative; }
.status-step .dot{ width:14px;height:14px;border-radius:50%; background:var(--line-strong); z-index:2; }
.status-step.done .dot{ background:var(--forest); }
.status-step.current .dot{ background:var(--gold); box-shadow:0 0 0 4px rgba(173,138,60,0.2); }
.status-step .lbl{ font-size:11px; color:var(--ink-soft); margin-top:8px; text-align:center; }
.status-step.done .lbl, .status-step.current .lbl{ color:var(--ink); font-weight:600; }
.status-line{ position:absolute; top:6px; left:-50%; width:100%; height:2px; background:var(--line-strong); z-index:1; }
.status-step.done .status-line{ background:var(--forest); }
.status-step:first-child .status-line{ display:none; }

.cart-item{ display:flex; gap:16px; padding:12px 0; border-bottom:1px solid var(--line); align-items:center; }
.cart-item .thumb{ width:48px;height:48px;border-radius:10px; display:flex;align-items:center;justify-content:center; font-size:24px; flex-shrink:0; background:var(--line); }
.cart-item .info{ flex:1; }
.cart-item .info .n{ font-weight:600; font-size:14px; }
.cart-item .amt{ font-weight:700; font-size:14px; text-align:right; }

.srow{ display:flex; justify-content:space-between; font-size:14px; color:var(--ink-soft); margin-bottom:10px; }
.srow.total{ color:var(--ink); font-weight:700; font-size:18px; border-top:1px solid var(--line); padding-top:14px; margin-top:6px; }

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
  <div style="margin-bottom:20px;">
      <a href="{{ route('orders.index') }}" style="font-size:14px; font-weight:600;">← Back to Orders</a>
  </div>
  
  <h1 class="serif" style="font-size:32px;font-weight:600;margin-bottom:24px;">Order Details</h1>

  <div class="order-card">
    <div class="order-top">
      <div><div class="oid">Order #{{ $order->id }}</div><div class="odate">Placed {{ $order->created_at->format('d M, Y h:i A') }}</div></div>
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

    <div style="font-size:13px; color:var(--ink-soft); margin-bottom:24px; padding:16px; background:var(--bg); border-radius:10px;">
        <div style="margin-bottom:8px;"><strong>Delivery Method:</strong> {{ $order->delivery_or_pickup }}</div>
        <div style="margin-bottom:8px;"><strong>Preferred Date:</strong> {{ date('d M, Y', strtotime($order->preferred_date)) }}</div>
        <div><strong>Payment Method:</strong> {{ $order->payment_method }}</div>
    </div>

    <h3 style="font-weight:700; margin-bottom:12px; font-size:16px;">Items</h3>
    
    @foreach($order->items as $item)
        <div class="cart-item">
            <div class="info">
                <div class="n">{{ $item->product_name }}</div>
                <div style="font-size:12px;color:var(--ink-soft);">{{ $item->quantity }} x ₹{{ number_format($item->price, 2) }}</div>
            </div>
            <div class="amt">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
        </div>
    @endforeach

    <div style="margin-top:24px;">
        <div class="srow total"><span>Total Paid</span><span>₹{{ number_format($order->total_amount, 2) }}</span></div>
    </div>

  </div>

</div>

@endsection
