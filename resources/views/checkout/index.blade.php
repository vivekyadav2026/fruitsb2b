@extends('layouts.storefront')

@section('content')

<style>
.ck-wrap{ padding:30px 0 80px; }
.ck-steps{ display:flex; align-items:center; gap:10px; margin-bottom:30px; font-size:13px; color:var(--ink-faint); }
.ck-steps .s{ display:flex; align-items:center; gap:8px; }
.ck-steps .n{ width:22px;height:22px;border-radius:50%; background:var(--line); display:flex;align-items:center;justify-content:center; font-size:11px; font-weight:700; }
.ck-steps .s.active{ color:var(--ink); font-weight:600; }
.ck-steps .s.active .n{ background:var(--forest); color:#fff; }
.ck-steps .s.done .n{ background:var(--success); color:#fff; }
.ck-steps .sep{ width:30px; height:1px; background:var(--line-strong); }

.ck-grid{ display:grid; grid-template-columns:1.4fr 1fr; gap:40px; align-items:flex-start; }
@media (max-width:880px){ .ck-grid{ grid-template-columns:1fr; } }

.summary-card{ background:var(--surface); border-radius:20px; border:1px solid var(--line); box-shadow:var(--shadow-md); padding:24px; position:sticky; top:90px; }
.summary-card h3{ font-size:17px; font-family:inherit; font-weight: 700; margin-bottom:16px; }
.srow{ display:flex; justify-content:space-between; font-size:14px; color:var(--ink-soft); margin-bottom:10px; }
.srow.total{ color:var(--ink); font-weight:700; font-size:18px; border-top:1px solid var(--line); padding-top:14px; margin-top:6px; }

.fulfil-choice{ display:flex; gap:10px; margin:18px 0; }
.fulfil-choice label{ flex:1; }
.fopt{ display:block; border:1.5px solid var(--line-strong); border-radius:12px; padding:12px; text-align:center; font-size:13px; cursor:pointer; font-weight:600; }
.fulfil-choice input[type="radio"]:checked + .fopt { border-color:var(--forest); background:rgba(15,51,38,0.05); color:var(--forest); font-weight:700; }
.fulfil-choice input[type="radio"] { display:none; }

.cart-item{ display:flex; gap:16px; padding:12px 0; border-bottom:1px solid var(--line); align-items:center; }
.cart-item .thumb{ width:48px;height:48px;border-radius:10px; display:flex;align-items:center;justify-content:center; font-size:24px; flex-shrink:0; }
.cart-item .info{ flex:1; }
.cart-item .info .n{ font-weight:600; font-size:14px; color: var(--ink); }
.cart-item .amt{ font-weight:700; font-size:14px; text-align:right; color: var(--forest); }

.ck-section-title { font-size: 24px; font-weight: 700; color: var(--ink); margin-bottom: 20px; }

@media (max-width: 768px) {
    .ck-wrap { padding: 20px 0 48px; }
    .ck-steps { margin-bottom: 20px; }
    .summary-card { position: static; padding: 18px; margin-top: 16px; }
    .ck-section-title { font-size: 20px; margin-bottom: 12px; }
}
</style>

<div class="container ck-wrap">
  <div class="ck-steps">
    <div class="s done"><span class="n">✓</span> Cart</div>
    <div class="sep"></div>
    <div class="s active"><span class="n">2</span> Checkout</div>
  </div>

  @if(session('error'))
      <div class="mb-4" style="background:var(--danger);color:#fff;padding:12px 20px;border-radius:var(--radius);font-weight:500;margin-bottom:20px;">
          {{ session('error') }}
      </div>
  @endif

  <form action="{{ route('checkout.store') }}" method="POST" class="ck-grid">
    @csrf
    <div>
      <h2 class="ck-section-title">Delivery Details</h2>
      
      <div class="field">
          <label>Delivery Method</label>
          <div class="fulfil-choice">
              <label>
                  <input type="radio" name="delivery_or_pickup" value="DELIVERY" required checked>
                  <div class="fopt">🚚 Delivery to Shop</div>
              </label>
              <label>
                  <input type="radio" name="delivery_or_pickup" value="PICKUP" required>
                  <div class="fopt">🏬 Self Pickup from Mandi</div>
              </label>
          </div>
      </div>

      <div class="field" style="margin-top:20px;">
          <label>Preferred Date</label>
          <input type="date" name="preferred_date" required min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
      </div>

      <div style="background:rgba(173,138,60,0.1); border-left:4px solid var(--gold); padding:16px; border-radius:4px; margin-top:30px; font-size:14px;">
          <strong>Note:</strong> Payment is strictly Cash on Delivery (COD) or upon Self Pickup. Online payment is coming soon.
      </div>
    </div>

    <div class="summary-card">
      <h3>Order Items</h3>
      @php $total = 0; @endphp
      @foreach($cart as $id => $item)
          @php $total += $item['price'] * $item['quantity']; @endphp
          <div class="cart-item">
              <div class="thumb" style="background:linear-gradient(160deg,{{ strtolower($item['category'] ?? '') == 'vegetables' ? '#E8F1E5,#D3E8CC' : '#FBEFE0,#F3D9AE' }});">
                @php
                    $emoji = '🍎';
                    $n = strtolower($item['name']);
                    if(str_contains($n, 'onion')) $emoji = '🧅';
                    elseif(str_contains($n, 'tomato')) $emoji = '🍅';
                    elseif(str_contains($n, 'banana')) $emoji = '🍌';
                    elseif(str_contains($n, 'potato')) $emoji = '🥔';
                    elseif(str_contains($n, 'orange')) $emoji = '🍊';
                    elseif(str_contains($n, 'cabbage')) $emoji = '🥬';
                    elseif(str_contains($n, 'chilli')) $emoji = '🌶️';
                @endphp
                {{ $emoji }}
              </div>
              <div class="info">
                  <div class="n">{{ $item['name'] }}</div>
                  <div style="font-size:12px;color:var(--ink-soft);">{{ $item['quantity'] }} {{ $item['unit'] }}</div>
              </div>
              <div class="amt">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
          </div>
      @endforeach

      <div style="margin-top:20px;">
          <div class="srow"><span>Subtotal</span><span>₹{{ number_format($total, 2) }}</span></div>
          <div class="srow total"><span>Total</span><span>₹{{ number_format($total, 2) }}</span></div>
      </div>

      <button type="submit" class="btn btn-primary btn-block" style="margin-top:20px;">Place Order</button>
    </div>
  </form>
</div>

@endsection
