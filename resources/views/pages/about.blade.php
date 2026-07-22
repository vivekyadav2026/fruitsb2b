@extends('layouts.storefront')

@section('content')
<style>
.about-hero { background: var(--forest); color: white; padding: 80px 0; text-align: center; }
.about-hero h1 { font-size: 42px; font-weight: 800; margin-bottom: 16px; }
.about-hero p { font-size: 18px; color: rgba(255,255,255,0.8); max-width: 700px; margin: 0 auto; line-height: 1.6; }

.about-section { padding: 80px 0; }
.about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
@media (max-width: 800px) { .about-grid { grid-template-columns: 1fr; } }
.about-img { width: 100%; height: 400px; object-fit: cover; border-radius: 12px; }

.val-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-top: 60px; }
@media (max-width: 700px) { .val-grid { grid-template-columns: 1fr; } }
.val-card { text-align: center; }
.val-icon { width: 64px; height: 64px; background: var(--gold-soft); color: var(--forest); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
.val-title { font-size: 18px; font-weight: 700; color: var(--ink); margin-bottom: 12px; }
.val-desc { font-size: 14px; color: var(--ink-soft); line-height: 1.6; }

@media (max-width: 768px) {
    .about-hero { padding: 48px 0; }
    .about-hero h1 { font-size: 26px; }
    .about-hero p { font-size: 14.5px; }
    .about-section { padding: 40px 0; }
    .about-grid h2 { font-size: 24px !important; margin-bottom: 16px !important; }
    .about-img { height: 260px; }
    .val-grid { margin-top: 40px; gap: 24px; }
}
</style>

<div class="about-hero">
    <div class="container">
        <h1>Transforming B2B Fresh Produce Procurement</h1>
        <p>Mandi Prime is India's most trusted wholesale trading platform, bridging the gap between farm-gate mandi arrivals and enterprise buyers.</p>
    </div>
</div>

<div class="container about-section">
    <div class="about-grid">
        <div>
            <h2 style="font-size:32px; font-weight:800; margin-bottom:24px;">Our Mission</h2>
            <p style="font-size:15px; color:var(--ink-soft); line-height:1.7; margin-bottom:16px;">
                For decades, bulk procurement of fresh fruits and vegetables has been plagued by opaque pricing, inconsistent quality, and logistical nightmares. Buyers had to physically visit the mandi at 4 AM to secure good stock.
            </p>
            <p style="font-size:15px; color:var(--ink-soft); line-height:1.7;">
                Mandi Prime digitizes this entire process. We operate directly out of the APMC yards, inspecting, grading, and digitizing the inventory in real-time. We provide transparent live rates, guaranteed quality grading, and seamless FTL/LTL dispatch to retailers, hotels, and distributors across the country.
            </p>
        </div>
        <div>
            <img src="/images/hero_warehouse.png" class="about-img" alt="Warehouse">
        </div>
    </div>

    <div class="val-grid">
        <div class="val-card">
            <div class="val-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
            <div class="val-title">Quality Assured Grading</div>
            <div class="val-desc">Every lot is manually inspected and assigned a strict grade (A/B/Premium) before being listed on the platform. What you see is what gets dispatched.</div>
        </div>
        <div class="val-card">
            <div class="val-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
            <div class="val-title">Transparent Mandi Rates</div>
            <div class="val-desc">Prices are updated live from the yard. The rate you see at checkout is locked in, protecting you from intra-day price volatility.</div>
        </div>
        <div class="val-card">
            <div class="val-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></div>
            <div class="val-title">Reliable Logistics</div>
            <div class="val-desc">From 1 Ton LTL to 50 Ton FTL trucks, our dispatch center handles all logistics to ensure your produce arrives fresh and on time.</div>
        </div>
    </div>
</div>
@endsection
