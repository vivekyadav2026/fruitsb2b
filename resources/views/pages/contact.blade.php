@extends('layouts.storefront')

@section('content')
<style>
.page-header { background: var(--surface); padding: 60px 0; border-bottom: 1px solid var(--line); margin-bottom: 60px; text-align: center; }
.page-title { font-size: 32px; font-weight: 800; color: var(--ink); margin-bottom: 16px; }

.contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; margin-bottom: 80px; }
@media (max-width: 800px) { .contact-grid { grid-template-columns: 1fr; } }

.c-info-box { background: white; border: 1px solid var(--line); border-radius: 12px; padding: 32px; box-shadow: var(--shadow-sm); }
.ci-item { display: flex; gap: 16px; margin-bottom: 24px; }
.ci-icon { width: 48px; height: 48px; background: var(--forest-soft); color: var(--forest); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.ci-title { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
.ci-desc { font-size: 14px; color: var(--ink-soft); line-height: 1.5; }

.contact-form { display: flex; flex-direction: column; gap: 20px; }
.form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: var(--ink); }
.form-control { width: 100%; padding: 12px 16px; border: 1px solid var(--line-strong); border-radius: 6px; font-size: 14px; outline: none; font-family: inherit; }
.form-control:focus { border-color: var(--forest); }
.btn-submit { background: var(--forest); color: white; padding: 14px; border: none; border-radius: 6px; font-weight: 700; font-size: 15px; cursor: pointer; transition: 0.2s; }
.btn-submit:hover { background: var(--forest-2); }
.form-row-stacked { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

@media (max-width: 768px) {
    .page-header { padding: 36px 0; margin-bottom: 24px; }
    .page-title { font-size: 24px; }
    .contact-grid { gap: 32px; margin-bottom: 40px; }
    .c-info-box { padding: 20px; }
    .form-row-stacked {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Trade Desk & Support</h1>
        <p style="color:var(--ink-soft); font-size:15px; max-width:600px; margin:0 auto;">Contact our wholesale trade desk for bulk pricing inquiries, FTL logistics support, or to schedule a warehouse visit.</p>
    </div>
</div>

<div class="container contact-grid">
    <div>
        <h3 style="font-size:24px; font-weight:700; margin-bottom:24px;">Send us an Inquiry</h3>
        <form class="contact-form" action="#" method="POST">
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" class="form-control" placeholder="e.g. ABC Retailers Pvt Ltd">
            </div>
            <div class="form-row-stacked">
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" class="form-control" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" placeholder="+91 00000 00000">
                </div>
            </div>
            <div class="form-group">
                <label>Inquiry Details (Commodities & Approx Volume)</label>
                <textarea class="form-control" rows="5" placeholder="I am looking for a daily supply of 2 Tons of A-Grade Onions..."></textarea>
            </div>
            <button type="button" class="btn-submit">Submit Inquiry</button>
        </form>
    </div>

    <div>
        <div class="c-info-box">
            <div class="ci-item">
                <div class="ci-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                <div>
                    <div class="ci-title">Trade Desk Helpline</div>
                    <div class="ci-desc">1800-MANDI-B2B<br>Available 4:00 AM to 2:00 PM (Mon-Sat)</div>
                </div>
            </div>
            <div class="ci-item">
                <div class="ci-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>
                <div>
                    <div class="ci-title">Email Support</div>
                    <div class="ci-desc">procurement@mandiprime.com<br>billing@mandiprime.com</div>
                </div>
            </div>
            <div class="ci-item" style="margin-bottom:0;">
                <div class="ci-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                <div>
                    <div class="ci-title">Central Wholesale Yard</div>
                    <div class="ci-desc">Gate No 4, Main APMC Market Yard,<br>Vashi, Navi Mumbai, Maharashtra 400703</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
