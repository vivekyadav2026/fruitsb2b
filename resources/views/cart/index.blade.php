@extends('layouts.storefront')

@section('content')

<style>
.ck-wrap{ padding:30px 0 80px; }
.ck-steps{ display:flex; align-items:center; gap:10px; margin-bottom:30px; font-size:13px; color:var(--ink-faint); }
.ck-steps .s{ display:flex; align-items:center; gap:8px; }
.ck-steps .n{ width:22px;height:22px;border-radius:50%; background:var(--line); display:flex;align-items:center;justify-content:center; font-size:11px; font-weight:700; }
.ck-steps .s.active{ color:var(--ink); font-weight:600; }
.ck-steps .s.active .n{ background:var(--forest); color:#fff; }
.ck-steps .sep{ width:30px; height:1px; background:var(--line-strong); }

.ck-grid{ display:grid; grid-template-columns:1.4fr 1fr; gap:40px; align-items:flex-start; }
@media (max-width:880px){ .ck-grid{ grid-template-columns:1fr; gap: 24px; } }

.cart-item{ display:flex; gap:16px; padding:18px 0; border-bottom:1px solid var(--line); align-items:center; }
.cart-item .thumb{ width:64px;height:64px;border-radius:14px; display:flex;align-items:center;justify-content:center; font-size:30px; flex-shrink:0; }
.cart-item .info{ flex:1; }
.cart-item .info .n{ font-weight:700; font-size:15px; color: var(--ink); }
.cart-item .info .v{ font-size:12.5px; color:var(--ink-soft); margin-bottom:4px; }
.cart-item .amt{ font-weight:800; font-size:16px; min-width:80px; text-align:right; color: var(--forest); }
.cart-item .rm{ background:none; border:none; color:var(--danger); font-size:12px; font-weight:600; cursor:pointer; margin-top:4px; padding: 2px 0; }

.summary-card{ background:var(--surface); border-radius:20px; border:1px solid var(--line); box-shadow:var(--shadow-md); padding:24px; position:sticky; top:90px; }
.summary-card h3{ font-size:17px; font-family:inherit; font-weight: 700; margin-bottom: 16px; }
.srow{ display:flex; justify-content:space-between; font-size:14px; color:var(--ink-soft); margin-bottom:10px; }
.srow.total{ color:var(--ink); font-weight:700; font-size:18px; border-top:1px solid var(--line); padding-top:14px; margin-top:6px; }

@media (max-width: 600px) {
    .ck-wrap { padding: 20px 0 48px; }
    .ck-steps { margin-bottom: 20px; }
    .cart-item {
        flex-wrap: wrap;
        padding: 14px 0;
        gap: 12px;
    }
    .cart-item .thumb { width: 52px; height: 52px; }
    .cart-item .info { flex: 1; min-width: 140px; }
    .cart-item .info .n { font-size: 14px; }
    .cart-item form { order: 3; margin-top: 4px; }
    .cart-item .amt-col { order: 4; margin-left: auto; text-align: right; }
    .summary-card { position: static; padding: 18px; }
}
</style>

<div class="container ck-wrap">
  <div class="ck-steps">
    <div class="s active"><span class="n">1</span> Cart</div>
    <div class="sep"></div>
    <div class="s"><span class="n">2</span> Checkout</div>
  </div>

  @if(session('success'))
      <div class="mb-4" style="background:var(--success);color:#fff;padding:12px 20px;border-radius:var(--radius);font-weight:500;margin-bottom:20px;">
          {{ session('success') }}
      </div>
  @endif

  <div class="ck-grid">
    <div>
      <h2 style="font-size:20px;font-weight:800;margin-bottom:12px;color:var(--ink);">Your Bag · {{ count($cart) }} items</h2>
      <div class="divider-dashed" style="margin-bottom:12px;"></div>

      @if(count($cart) > 0)
          @php $total = 0; @endphp
          @foreach($cart as $id => $details)
            @php 
                $subtotal = $details['price'] * $details['quantity'];
                $total += $subtotal;
            @endphp
            <div class="cart-item">
              <div class="thumb">
                  <img src="{{ asset($details['image_url'] ?? '/images/products/default.jpg') }}" alt="{{ $details['name'] }}" style="width:100%; height:100%; object-fit:cover; border-radius:12px;">
              </div>
              <div class="info"><div class="n">{{ $details['name'] }}</div><div class="v">₹{{ number_format($details['price'], 2) }}/{{ $details['unit'] }}</div></div>
              
              <form action="{{ route('cart.update') }}" method="POST" style="margin:0;">
                  @csrf
                  <input type="hidden" name="id" value="{{ $id }}">
                  <div class="stepper-wrap" style="display:flex; align-items:center; border:1.5px solid rgba(15, 51, 38, 0.15); border-radius:8px; overflow:hidden; height:34px; background:var(--surface);">
                      <button type="button" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.dispatchEvent(new Event('change'))" style="border:none; background:transparent; width:30px; height:100%; cursor:pointer; font-weight:700; color:var(--forest);">−</button>
                      <input type="number" name="quantity" value="{{ $details['quantity'] }}" step="any" onchange="this.form.submit()" style="width:40px; border:none; text-align:center; font-weight:700; font-size:13px; height:100%; background:transparent; color:var(--ink); -moz-appearance:textfield; padding:0;">
                      <button type="button" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.dispatchEvent(new Event('change'))" style="border:none; background:transparent; width:30px; height:100%; cursor:pointer; font-weight:700; color:var(--forest);">+</button>
                  </div>
              </form>
              
              <div class="amt-col">
                <div class="amt">₹{{ number_format($subtotal, 2) }}</div>
                <form action="{{ route('cart.remove') }}" method="POST" style="margin:0; text-align:right;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button type="submit" class="rm">Remove</button>
                </form>
              </div>
            </div>
          @endforeach
      @else
          <div style="text-align:center; padding:60px 0;">
              <div style="font-size:40px;margin-bottom:10px;">🛒</div>
              <h3 style="font-size:18px;font-weight:600;">Your cart is empty</h3>
              <p style="color:var(--ink-soft);margin-bottom:20px;">Looks like you haven't added any products yet.</p>
              <a href="{{ route('home') }}" class="btn btn-primary">Start Shopping</a>
          </div>
      @endif
    </div>

    @if(count($cart) > 0)
    <div class="summary-card">
      <h3>Order Summary</h3>
      <div class="srow"><span>Subtotal</span><span>₹{{ number_format($total, 2) }}</span></div>
      <div class="srow"><span>Loading charge</span><span>₹0</span></div>
      <div class="srow"><span>Delivery</span><span>Calculated at checkout</span></div>
      <div class="srow total"><span>Total</span><span>₹{{ number_format($total, 2) }}</span></div>

      <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block" style="margin-top:20px;">Continue to Checkout</a>
    </div>
    @endif
  </div>
</div>

@endsection
