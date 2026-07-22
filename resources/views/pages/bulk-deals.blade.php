@extends('layouts.storefront')

@section('content')
<style>
.page-header { background: var(--forest); color: white; padding: 60px 0; margin-bottom: 40px; }
.page-title { font-size: 32px; font-weight: 800; margin-bottom: 12px; display: flex; align-items: center; gap: 12px; }
.page-desc { font-size: 15px; color: rgba(255,255,255,0.8); max-width: 600px; line-height: 1.6; }

.deal-card { border: 1px solid var(--line); border-radius: 12px; padding: 24px; display: flex; gap: 24px; margin-bottom: 24px; background: white; align-items: center; box-shadow: var(--shadow-sm); }
@media (max-width: 800px) { .deal-card { flex-direction: column; align-items: stretch; } }
.dc-info { flex: 1; }
.dc-title { font-size: 20px; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
.dc-desc { font-size: 14px; color: var(--ink-soft); margin-bottom: 16px; line-height: 1.5; }
.dc-meta { display: flex; gap: 16px; font-size: 12px; font-weight: 600; color: var(--forest); background: var(--bg); padding: 8px 12px; border-radius: 6px; display: inline-flex; }

.dc-price { padding: 0 24px; border-left: 1px dashed var(--line-strong); text-align: center; min-width: 200px; }
@media (max-width: 800px) { .dc-price { border-left: none; border-top: 1px dashed var(--line-strong); padding: 24px 0 0; text-align: left; } }
.dc-price-old { text-decoration: line-through; color: var(--ink-faint); font-size: 14px; margin-bottom: 4px; }
.dc-price-new { font-size: 32px; font-weight: 800; color: var(--gold); margin-bottom: 4px; line-height: 1; }
.dc-price-unit { font-size: 12px; color: var(--ink-soft); font-weight: 600; margin-bottom: 16px; }

.btn-deal { width: 100%; background: var(--forest); color: white; padding: 12px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px; }
.btn-deal:hover { background: var(--forest-2); }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            Truckload Bulk Deals
        </h1>
        <p class="page-desc">Massive discounts available on full-truckload (FTL) or extremely high-volume purchases. These deals are updated daily based on excess yard arrivals.</p>
    </div>
</div>

<div class="container" style="padding-bottom: 80px;">
    
    @foreach($deals as $deal)
    <div class="deal-card">
        <div class="dc-info">
            <div class="dc-title">{{ $deal->title }}</div>
            <div class="dc-desc">{{ $deal->description }}</div>
            <div class="dc-meta">
                <span>MOQ: {{ $deal->moq }} {{ $deal->product->unit ?? 'Kg' }}</span>
                <span>•</span>
                <span>Valid till: {{ $deal->valid_until->format('h:i A') }}</span>
            </div>
        </div>
        <div class="dc-price">
            <div class="dc-price-old">Market: ₹{{ number_format($deal->old_price, 2) }} / {{ $deal->product->unit ?? 'Kg' }}</div>
            <div class="dc-price-new">₹{{ number_format($deal->new_price, 2) }}</div>
            <div class="dc-price-unit">per {{ $deal->product->unit ?? 'Kg' }} (Flat Rate)</div>
            <button class="btn-deal">Contact Trade Desk</button>
        </div>
    </div>
    @endforeach

</div>
@endsection
