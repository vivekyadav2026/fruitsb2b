@extends('layouts.storefront')

@section('content')
<style>
.pd-wrap{ padding: 40px 0 80px; }
.breadcrumb{ font-size:13px; color:var(--ink-faint); margin-bottom:24px; display: flex; align-items: center; gap: 8px;}
.breadcrumb a{ color:var(--ink-soft); text-decoration: none; }
.breadcrumb a:hover{ color:var(--forest); }
.breadcrumb b{ color:var(--ink); font-weight:600; }

.pd-grid{ display:grid; grid-template-columns: 1fr 1fr; gap: 40px; }
@media (max-width:900px){ .pd-grid{ grid-template-columns:1fr; } }

/* Image Gallery */
.gallery-main { width: 100%; height: 450px; background: var(--surface); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; margin-bottom: 16px; box-shadow: var(--shadow-sm); }
.gallery-main img { width: 100%; height: 100%; object-fit: cover; }
.gallery-thumbs { display: flex; gap: 12px; }
.gallery-thumbs .t { width: 80px; height: 80px; border-radius: 8px; border: 2px solid transparent; overflow: hidden; cursor: pointer; opacity: 0.7; transition: 0.2s; }
.gallery-thumbs .t img { width: 100%; height: 100%; object-fit: cover; }
.gallery-thumbs .t:hover, .gallery-thumbs .t.active { opacity: 1; border-color: var(--gold); }

/* Price Chart Placeholder */
.chart-container { background: white; border: 1px solid var(--line); border-radius: 12px; padding: 24px; margin-top: 40px; box-shadow: var(--shadow-sm); }
.chart-container h3 { font-size: 16px; font-weight: 700; margin-bottom: 16px; color: var(--ink); }
.chart-placeholder { height: 200px; display: flex; align-items: flex-end; gap: 10px; padding-top: 20px; border-bottom: 1px solid var(--line-strong); border-left: 1px solid var(--line-strong); padding-left: 10px; position: relative; }
.chart-bar { flex: 1; background: var(--forest-soft); border-radius: 4px 4px 0 0; position: relative; transition: 0.3s; cursor: pointer; min-width: 30px; }
.chart-bar:hover { background: var(--forest); }
.chart-lbl { position: absolute; bottom: -24px; width: 100%; text-align: center; font-size: 11px; color: var(--ink-soft); }

/* Commodity Header */
.pd-header { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--line); }
.pd-badges { display: flex; gap: 10px; margin-bottom: 16px; flex-wrap: wrap; }
.badge { font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px; border: 1px solid; display: inline-flex; align-items: center; gap: 6px; }
.badge.grade { background: var(--gold-soft); border-color: #FDE68A; color: #946A1A; }
.badge.gst { background: #F0FDF4; border-color: #BBF7D0; color: #166534; }
.pd-name{ font-size:36px; font-weight:800; margin:0 0 12px; letter-spacing: -0.5px; line-height: 1.2; }
.pd-meta { display: flex; flex-wrap: wrap; gap: 20px; font-size: 13.5px; color: var(--ink-soft); }
.pd-meta div { display: flex; align-items: center; gap: 6px; }

/* Pricing Box */
.price-box { background: var(--surface); border-radius: 12px; padding: 24px; margin-bottom: 24px; border: 1px solid var(--line); }
.price-box .label { font-size: 12px; font-weight: 700; color: var(--ink-soft); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: block; }
.pd-price-row{ display:flex; align-items:baseline; gap:12px; margin-bottom:12px; }
.pd-price-row .val{ font-size:42px; font-weight:800; color:var(--forest); }
.pd-price-row .unit{ font-size:16px; color:var(--ink-soft); font-weight: 600; }
.pd-updated{ font-size:12.5px; color:var(--ink-faint); display: flex; align-items: center; gap: 6px; }

/* Order Form */
.moq-card{ display:flex; gap:10px; align-items:flex-start; background: var(--bg); border-radius:8px; padding:16px; font-size:13px; margin-bottom:24px; border: 1px solid var(--line-strong); }
.qty-control { margin-bottom: 24px; }
.qty-control label { display: block; font-size: 14px; font-weight: 700; margin-bottom: 10px; color: var(--ink); }
.stepper{ display:inline-flex; align-items:center; border:1px solid var(--line-strong); border-radius:6px; overflow:hidden; }
.stepper button{ width:48px;height:48px; border:none; background:white; font-size:20px; cursor:pointer; color: var(--ink-soft); transition: 0.2s; }
.stepper button:hover { background: var(--surface); color: var(--ink); }
.stepper input{ width:80px; text-align:center; border:none; border-left:1px solid var(--line); border-right:1px solid var(--line); height:48px; font-size:16px; font-weight: 700; background:white;}
.btn-po { width: 100%; display: flex; justify-content: center; align-items: center; gap: 10px; background: var(--forest); color: white; border: none; padding: 16px; border-radius: 8px; font-size: 15px; font-weight: 700; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 12px rgba(15, 51, 38, 0.2); }
.btn-po:hover { background: var(--forest-2); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(15, 51, 38, 0.3); }
.btn-po:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }

/* Commodity Details Table */
.spec-table { width: 100%; border-collapse: collapse; margin-top: 30px; }
.spec-table th, .spec-table td { padding: 14px 16px; text-align: left; border-bottom: 1px solid var(--line); font-size: 14px; }
.spec-table th { background: var(--surface); font-weight: 600; color: var(--ink-soft); width: 35%; border-radius: 6px 0 0 6px; }
.spec-table td { font-weight: 500; border-radius: 0 6px 6px 0; }

@media (max-width: 768px) {
    .pd-wrap { padding: 24px 0 48px; }
    .pd-name { font-size: 26px; margin-bottom: 8px; }
    .gallery-main { height: 280px; margin-bottom: 12px; }
    .gallery-thumbs .t { width: 64px; height: 64px; }
    .pd-price-row .val { font-size: 32px; }
    .pd-price-row .unit { font-size: 14px; }
    .price-box { padding: 18px; }
    .spec-table th, .spec-table td { padding: 10px 12px; font-size: 13px; }
    .spec-table th { width: 40%; }
    .chart-container { padding: 18px; margin-top: 24px; }
    .chart-placeholder { height: 160px; }
    .chart-lbl { font-size: 10px; bottom: -20px; }
}
</style>

<div class="container pd-wrap">
  <div class="breadcrumb">
      <a href="{{ route('home') }}">Home</a> 
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
      <a href="{{ route('categories') }}">{{ $product->category->name ?? 'Uncategorized' }}</a>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
      <b>{{ $product->name }}</b>
  </div>
  
  @if(session('success'))
      <div style="background:var(--success);color:#fff;padding:16px 20px;border-radius:8px;font-weight:600;margin-bottom:24px; font-size:14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
          {{ session('success') }}
      </div>
  @endif

  <div class="pd-grid">
    <!-- Left Column: Imagery & Charts -->
    <div>
      <div class="gallery-main">
          @if($product->image_url)
              <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
          @else
              <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:var(--forest); color:var(--gold); font-size:64px;">
                  <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
              </div>
          @endif
      </div>
      <div class="gallery-thumbs">
          @if($product->image_url)
            <div class="t active"><img src="{{ asset($product->image_url) }}"></div>
            <!-- Simulating multiple images for the premium feel -->
            <div class="t"><img src="{{ asset($product->image_url) }}" style="filter: brightness(0.8);"></div>
            <div class="t"><img src="{{ asset($product->image_url) }}" style="filter: brightness(0.9) contrast(1.2);"></div>
          @endif
      </div>

      <div class="chart-container">
          <h3>7-Day Price History ({{ $product->unit }})</h3>
          <div class="chart-placeholder">
              <div class="chart-bar" style="height: 60%;"><div class="chart-lbl">Mon</div></div>
              <div class="chart-bar" style="height: 65%;"><div class="chart-lbl">Tue</div></div>
              <div class="chart-bar" style="height: 55%;"><div class="chart-lbl">Wed</div></div>
              <div class="chart-bar" style="height: 70%;"><div class="chart-lbl">Thu</div></div>
              <div class="chart-bar" style="height: 75%; background: var(--forest);"><div class="chart-lbl">Fri</div></div>
              <div class="chart-bar" style="height: 80%;"><div class="chart-lbl">Sat</div></div>
              <div class="chart-bar" style="height: 85%;"><div class="chart-lbl">Sun</div></div>
          </div>
      </div>
    </div>

    <!-- Right Column: Details & Order Form -->
    <div>
      <div class="pd-header">
          <div class="pd-badges">
              <span class="badge grade"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> Grade {{ $product->grade ?? 'A' }}</span>
              @if($product->is_gst_available)
                <span class="badge gst"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg> GST Invoice Available</span>
              @endif
          </div>
          <h1 class="pd-name">{{ $product->name }}</h1>
          <div class="pd-meta">
              <div>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  Origin: {{ $product->origin ?? 'Local Mandi' }}
              </div>
              <div>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                  Category: {{ $product->category->name ?? 'Uncategorized' }}
              </div>
          </div>
      </div>
            
      <div class="price-box">
          <span class="label">Live Wholesale Rate</span>
          <div class="pd-price-row">
              <span class="val">₹{{ number_format($product->price_per_unit, 2) }}</span>
              <span class="unit">/ {{ $product->unit }}</span>
          </div>
          
          <div class="pd-updated">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              Rate updated {{ $product->updated_at->diffForHumans() }}
              
              @if($product->price_trend_direction === 'UP')
                  <span style="color:var(--danger); font-weight:600; margin-left:8px;">(Trending Up {{ $product->price_trend_value }}%)</span>
              @elseif($product->price_trend_direction === 'DOWN')
                  <span style="color:var(--success); font-weight:600; margin-left:8px;">(Trending Down {{ $product->price_trend_value }}%)</span>
              @endif
          </div>
      </div>

      <div class="moq-card">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--forest)" stroke-width="2" style="flex-shrink:0; margin-top:2px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
          <div>
            <strong style="color:var(--ink); display:block; margin-bottom:4px;">Minimum Order Requirement</strong>
            Wholesale orders must be at least {{ $product->min_order_qty }} {{ $product->unit }}s. Goods are packed and dispatched in standard mandi crates/bags.
          </div>
      </div>

      <form action="{{ route('cart.add') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          
          <div class="qty-control">
              <label>Order Quantity ({{ $product->unit }}s)</label>
              <div style="display:flex; gap:16px; align-items:center;">
                  <div class="stepper">
                      <button type="button" onclick="let i=document.getElementById('qty'); if(i.value > {{ $product->min_order_qty }}) i.value = parseFloat(i.value)-1;">−</button>
                      <input id="qty" type="number" name="quantity" value="{{ $product->min_order_qty }}" min="{{ $product->min_order_qty }}">
                      <button type="button" onclick="let i=document.getElementById('qty'); i.value = parseFloat(i.value)+1;">+</button>
                  </div>
                  @if($product->stock_status == 'OUT_OF_STOCK')
                    <span style="color:var(--danger); font-weight:700;">Out of Stock</span>
                  @else
                    <span style="color:var(--success); font-weight:700;">Ready for Dispatch</span>
                  @endif
              </div>
          </div>

          @if($product->stock_status == 'OUT_OF_STOCK')
              <button type="button" class="btn-po" disabled>Out of Stock</button>
          @else
              <button type="submit" class="btn-po">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                  Add to Purchase Order
              </button>
          @endif
      </form>

      <table class="spec-table">
          <tbody>
              <tr>
                  <th>Product Description</th>
                  <td>{{ $product->description ?? 'Premium quality produce, sorted and graded at the yard this morning. Assured quality for wholesale buyers.' }}</td>
              </tr>
              <tr>
                  <th>Delivery Options</th>
                  <td>
                      @if($product->is_delivery_available) 🚚 Logistics Support @endif
                      @if($product->is_delivery_available && $product->is_pickup_available) &nbsp;|&nbsp; @endif
                      @if($product->is_pickup_available) 📦 Self-Pickup from Yard @endif
                  </td>
              </tr>
              <tr>
                  <th>Disptach Time</th>
                  <td>Same day dispatch for orders placed before 10 AM.</td>
              </tr>
          </tbody>
      </table>

    </div>
  </div>
</div>
@endsection
