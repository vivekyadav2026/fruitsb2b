@extends('layouts.storefront')

@section('content')

<style>
/* =====================================================
   HERO BANNER
===================================================== */
.hero-banner {
    background: linear-gradient(150deg, #061a11 0%, #0c2e1e 60%, #143d28 100%);
    position: relative;
    overflow: hidden;
    color: white;
}
.hero-banner::before {
    content: '';
    position: absolute; inset: 0;
    background-image: url('/images/hero_warehouse.png');
    background-size: cover;
    background-position: center;
    opacity: 0.18;
}
.hero-inner {
    position: relative; z-index: 1;
    max-width: 1180px;
    margin: 0 auto;
    padding: 72px 28px 80px;
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 48px;
    align-items: center;
}

/* Left side */
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(217,164,65,0.15);
    border: 1px solid rgba(217,164,65,0.35);
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 12px; font-weight: 700;
    color: #f0c060;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 20px;
}
.hero-eyebrow-dot {
    width: 7px; height: 7px;
    background: #4ade80;
    border-radius: 50%;
    animation: pulse 1.6s ease-in-out infinite;
}
@keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.75)} }

.hero-h1 {
    font-size: 46px; font-weight: 800;
    line-height: 1.1; letter-spacing: -1.5px;
    margin: 0 0 18px;
}
.hero-h1 span { color: #D9A441; }
.hero-sub {
    font-size: 17px; line-height: 1.65;
    color: rgba(255,255,255,0.72);
    margin: 0 0 36px;
    max-width: 480px;
}
.hero-btns { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 44px; }
.btn-gold-solid {
    display: inline-flex; align-items: center; gap: 8px;
    background: #D9A441; color: #0c2e1e;
    font-weight: 700; font-size: 15px;
    padding: 14px 28px; border-radius: 10px;
    text-decoration: none; border: none; cursor: pointer;
    box-shadow: 0 8px 24px rgba(217,164,65,0.35);
    transition: filter .2s, transform .2s;
}
.btn-gold-solid:hover { filter: brightness(1.08); transform: translateY(-1px); }
.btn-ghost-w {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.08);
    border: 1.5px solid rgba(255,255,255,0.22);
    color: white; font-weight: 600; font-size: 15px;
    padding: 14px 24px; border-radius: 10px;
    text-decoration: none; cursor: pointer;
    transition: background .2s;
}
.btn-ghost-w:hover { background: rgba(255,255,255,0.15); }

.hero-stats-row {
    display: flex; gap: 0;
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 14px;
    overflow: hidden;
    width: fit-content;
}
.hero-stat {
    padding: 16px 28px;
    border-right: 1px solid rgba(255,255,255,0.12);
}
.hero-stat:last-child { border-right: none; }
.hero-stat-val { font-size: 24px; font-weight: 800; color: #D9A441; line-height: 1; margin-bottom: 4px; }
.hero-stat-lbl { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: rgba(255,255,255,0.5); }

/* Right: Highlights card */
.hl-box {
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.14);
    border-radius: 20px;
    padding: 24px;
    color: white;
}
.hl-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 20px; padding-bottom: 16px;
    border-bottom: 1px solid rgba(255,255,255,0.12);
}
.hl-header h3 { font-size: 14px; font-weight: 700; margin: 0; }
.live-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(74,222,128,0.15); border: 1px solid rgba(74,222,128,0.3);
    border-radius: 999px; padding: 4px 10px;
    font-size: 11px; font-weight: 700; color: #4ade80;
}
.live-dot { width:6px;height:6px;border-radius:50%;background:#4ade80; animation:pulse 1.4s infinite; }

.ticker-item {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.ticker-item:last-child { border-bottom: none; padding-bottom: 0; }
.ti-icon {
    width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.ti-icon.up  { background: rgba(16,185,129,0.2); color: #4ade80; }
.ti-icon.down { background: rgba(239,68,68,0.2);  color: #f87171; }
.ti-icon.star { background: rgba(217,164,65,0.2);  color: #D9A441; }
.ti-title { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.9); margin-bottom: 3px; }
.ti-desc  { font-size: 11.5px; color: rgba(255,255,255,0.5); line-height: 1.4; }

/* =====================================================
   MOBILE HIGHLIGHTS STRIP  (hidden on desktop)
===================================================== */
.mobile-hl-strip { display: none; }

/* =====================================================
   SECTION / CATALOG
===================================================== */
.section-title {
    font-size: 22px; font-weight: 700;
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 20px;
}
.section-title a { font-size: 13px; font-weight: 600; color: var(--forest); text-decoration: none; }

/* Category grid */
.cat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-bottom: 48px;
}
.cat-card {
    background: white; border: 1.5px solid var(--line);
    border-radius: 16px; padding: 24px 12px 20px;
    text-align: center; text-decoration: none; color: inherit;
    display: flex; flex-direction: column; align-items: center;
    transition: border-color .2s, box-shadow .2s, transform .2s;
}
.cat-card:hover { border-color: var(--forest); box-shadow: 0 8px 24px rgba(0,0,0,0.09); transform: translateY(-3px); }
.cat-icon {
    width: 60px; height: 60px; border-radius: 16px;
    background: var(--forest); color: var(--gold);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 14px; flex-shrink: 0;
}
.cat-name { font-weight: 700; font-size: 14px; margin-bottom: 4px; }
.cat-count { font-size: 12px; color: var(--ink-soft); }

/* Product grid */
.card-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; }
@media (max-width:1100px) { .card-grid { grid-template-columns: repeat(3,1fr); } .cat-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width:720px)  { .card-grid { grid-template-columns: repeat(2,1fr); gap:12px; } }

/* =====================================================
   MOBILE  ≤ 768px
===================================================== */
@media (max-width: 768px) {

    /* ── Banner ─────────────────────────────────────── */
    .hero-banner::before { opacity: 0.12; }
    .hero-inner {
        display: flex;
        flex-direction: column;
        padding: 36px 20px 40px;
        gap: 0;
    }
    .hero-eyebrow { font-size: 11px; padding: 5px 12px; margin-bottom: 16px; }
    .hero-h1 { font-size: 28px; letter-spacing: -0.8px; margin-bottom: 12px; }
    .hero-sub  { font-size: 14px; margin-bottom: 24px; }
    .hero-btns { margin-bottom: 28px; gap: 10px; }
    .btn-gold-solid { font-size: 14px; padding: 12px 22px; border-radius: 50px; }
    .btn-ghost-w    { display: none; }
    .hero-stats-row { display: none; }

    /* ── Desktop highlights box → hidden ─────────────── */
    .hl-box { display: none !important; }

    /* ── Mobile highlights strip ─────────────────────── */
    .mobile-hl-strip {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        padding: 16px 20px 6px;
        background: #f8f9f8;
    }
    .mobile-hl-strip::-webkit-scrollbar { display: none; }

    .mhl-card {
        flex: 0 0 175px;
        background: white;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        padding: 12px 14px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        display: flex; gap: 10px; align-items: flex-start;
    }
    .mhl-icon {
        width: 34px; height: 34px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .mhl-icon.up   { background: #dcfce7; color: #16a34a; }
    .mhl-icon.down { background: #fee2e2; color: #dc2626; }
    .mhl-icon.star { background: #fef9c3; color: #ca8a04; }
    .mhl-t { font-size: 12.5px; font-weight: 700; color: #111827; line-height: 1.3; margin-bottom: 2px; }
    .mhl-d { font-size: 11px; color: #6b7280; line-height: 1.4; }

    /* ── Category section ────────────────────────────── */
    .cat-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px; margin-bottom: 32px;
    }
    .cat-card { padding: 20px 12px 18px; border-radius: 18px; }
    .cat-icon  { width: 56px; height: 56px; border-radius: 15px; margin-bottom: 12px; }
    .cat-icon svg { width: 26px; height: 26px; }
    .cat-name  { font-size: 14px; }
    .cat-count { font-size: 11.5px; }

    /* ── Section header ──────────────────────────────── */
    .section-title { font-size: 19px; margin-bottom: 14px; }

    /* ── Catalog padding ─────────────────────────────── */
    #catalog { padding-top: 28px !important; padding-bottom: 48px !important; }
}

@media (max-width: 900px) {
    .hero-inner { grid-template-columns: 1fr; }
}

/* =====================================================
   EXTRA SECTIONS
===================================================== */

/* ── Stats Strip ── */
.stats-strip {
    background: var(--forest);
    padding: 0;
    overflow: hidden;
}
.stats-inner {
    max-width: 1180px; margin: 0 auto; padding: 0 28px;
    display: grid; grid-template-columns: repeat(4, 1fr);
}
.stat-item {
    padding: 36px 24px; text-align: center; color: white;
    border-right: 1px solid rgba(255,255,255,0.1);
    position: relative;
}
.stat-item:last-child { border-right: none; }
.stat-num {
    font-size: 40px; font-weight: 800; color: #D9A441;
    letter-spacing: -1.5px; line-height: 1;
    margin-bottom: 6px;
}
.stat-label {
    font-size: 13px; font-weight: 600;
    color: rgba(255,255,255,0.65);
    text-transform: uppercase; letter-spacing: 0.07em;
}

/* ── How It Works ── */
.hiw-section {
    padding: 80px 0;
    background: white;
}
.home-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(15,51,38,0.07);
    border: 1px solid rgba(15,51,38,0.14);
    border-radius: 999px; padding: 6px 14px;
    font-size: 11.5px; font-weight: 700; color: var(--forest);
    letter-spacing: 0.07em; text-transform: uppercase;
    margin-bottom: 14px;
}
.home-section-title {
    font-size: 32px; font-weight: 800; letter-spacing: -0.8px;
    color: var(--ink); margin: 0 0 12px;
    line-height: 1.15;
}
.home-section-sub {
    font-size: 16px; color: var(--ink-soft);
    line-height: 1.6; max-width: 520px;
    margin: 0 auto 56px;
}
.hiw-grid {
    max-width: 1180px; margin: 0 auto; padding: 0 28px;
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}
.hiw-card {
    position: relative; text-align: center;
    padding: 40px 28px;
    background: var(--bg);
    border-radius: 20px;
    border: 1.5px solid var(--line);
    transition: border-color .2s, box-shadow .2s, transform .2s;
}
.hiw-card:hover { border-color: var(--forest); box-shadow: 0 12px 40px rgba(0,0,0,0.08); transform: translateY(-4px); }
.hiw-step-num {
    position: absolute; top: -18px; left: 50%; transform: translateX(-50%);
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--forest); color: white;
    font-size: 14px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 12px rgba(15,51,38,0.35);
}
.hiw-icon {
    width: 68px; height: 68px; border-radius: 20px;
    background: linear-gradient(135deg, rgba(15,51,38,0.1), rgba(15,51,38,0.06));
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px; color: var(--forest);
}
.hiw-title { font-size: 18px; font-weight: 700; margin-bottom: 10px; color: var(--ink); }
.hiw-desc  { font-size: 14px; color: var(--ink-soft); line-height: 1.65; }

/* connector line between steps */
.hiw-connector {
    display: flex; align-items: center; justify-content: center;
    padding-top: 40px;
}
.hiw-connector::before {
    content: '';
    position: absolute;
    top: 50px; left: calc(100% + 16px);
    width: 32px; height: 2px;
    background: repeating-linear-gradient(90deg, var(--gold) 0, var(--gold) 6px, transparent 6px, transparent 12px);
}

/* ── Why Choose Us ── */
.why-section {
    padding: 80px 0;
    background: linear-gradient(150deg, #061a11 0%, #0c2e1e 100%);
    color: white;
    position: relative; overflow: hidden;
}
.why-section::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(ellipse at 80% 50%, rgba(217,164,65,0.08) 0%, transparent 60%);
    pointer-events: none;
}
.why-inner { max-width: 1180px; margin: 0 auto; padding: 0 28px; position: relative; z-index: 1; }
.why-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; margin-top: 48px;
}
.why-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px; padding: 32px 28px;
    transition: background .2s, border-color .2s;
}
.why-card:hover { background: rgba(255,255,255,0.09); border-color: rgba(217,164,65,0.35); }
.why-icon {
    width: 52px; height: 52px; border-radius: 14px;
    background: rgba(217,164,65,0.15);
    border: 1px solid rgba(217,164,65,0.25);
    display: flex; align-items: center; justify-content: center;
    color: #D9A441; margin-bottom: 20px;
}
.why-title { font-size: 17px; font-weight: 700; color: white; margin-bottom: 10px; }
.why-desc  { font-size: 13.5px; color: rgba(255,255,255,0.55); line-height: 1.7; }

/* ── Testimonials ── */
.testi-section { padding: 80px 0; background: var(--bg); }
.testi-grid {
    max-width: 1180px; margin: 0 auto; padding: 0 28px;
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; margin-top: 48px;
}
.testi-card {
    background: white; border-radius: 20px;
    border: 1.5px solid var(--line); padding: 32px;
    transition: box-shadow .2s, transform .2s;
    display: flex; flex-direction: column;
}
.testi-card:hover { box-shadow: 0 12px 40px rgba(0,0,0,0.09); transform: translateY(-3px); }
.testi-stars { display: flex; gap: 3px; margin-bottom: 16px; }
.testi-star { color: #D9A441; font-size: 16px; }
.testi-quote {
    font-size: 14.5px; line-height: 1.75;
    color: var(--ink-soft); flex: 1; margin-bottom: 24px;
    font-style: italic;
}
.testi-author { display: flex; align-items: center; gap: 12px; }
.testi-avatar {
    width: 44px; height: 44px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 800; color: white;
    flex-shrink: 0;
}
.testi-name { font-size: 14px; font-weight: 700; color: var(--ink); }
.testi-role { font-size: 12px; color: var(--ink-soft); }

/* ── CTA Banner ── */
.cta-banner {
    background: linear-gradient(135deg, #D9A441 0%, #c28b2a 100%);
    padding: 64px 28px;
    text-align: center;
}
.cta-banner h2 { font-size: 32px; font-weight: 800; color: #061a11; margin: 0 0 12px; letter-spacing: -0.6px; }
.cta-banner p  { font-size: 16px; color: rgba(6,26,17,0.7); margin: 0 0 32px; }
.cta-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
.cta-btn-dark {
    display: inline-flex; align-items: center; gap: 8px;
    background: #061a11; color: white;
    font-weight: 700; font-size: 15px;
    padding: 14px 28px; border-radius: 10px;
    text-decoration: none; transition: opacity .2s;
}
.cta-btn-dark:hover { opacity: 0.85; }
.cta-btn-outline {
    display: inline-flex; align-items: center; gap: 8px;
    background: transparent;
    border: 2px solid rgba(6,26,17,0.3);
    color: #061a11; font-weight: 700; font-size: 15px;
    padding: 14px 28px; border-radius: 10px;
    text-decoration: none; transition: border-color .2s;
}
.cta-btn-outline:hover { border-color: #061a11; }

/* ── Mobile extra sections ── */
@media (max-width: 768px) {
    .stats-inner { grid-template-columns: repeat(2,1fr); }
    .stat-item { padding: 28px 16px; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .stat-item:nth-child(odd) { border-right: 1px solid rgba(255,255,255,0.1); }
    .stat-num { font-size: 30px; }
    .stat-label { font-size: 11.5px; }

    .hiw-section { padding: 56px 0; }
    .hiw-grid { grid-template-columns: 1fr; gap: 36px; padding: 0 20px; }
    .home-section-title { font-size: 24px; }
    .home-section-sub { font-size: 14px; margin-bottom: 36px; padding: 0 20px; }

    .why-section { padding: 56px 0; }
    .why-inner { padding: 0 20px; }
    .why-grid { grid-template-columns: 1fr; gap: 16px; }
    .why-card { padding: 24px 20px; }

    .testi-section { padding: 56px 0; }
    .testi-grid { grid-template-columns: 1fr; gap: 16px; padding: 0 20px; margin-top: 32px; }
    .testi-card { padding: 24px 20px; }

    .cta-banner { padding: 48px 20px; }
    .cta-banner h2 { font-size: 24px; }
    .cta-banner p  { font-size: 14px; }
    .cta-btn-dark, .cta-btn-outline { width: 100%; justify-content: center; }
    .cta-btns { flex-direction: column; }
}
</style>

{{-- ══════════════════════════════════════════════════
     HERO BANNER
══════════════════════════════════════════════════ --}}
<div class="hero-banner">
    <div class="hero-inner">

        {{-- Left Column --}}
        <div>
            <div class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Live Mandi Rates · B2B Wholesale
            </div>
            <h1 class="hero-h1">India's Premier<br><span>Fresh Produce</span><br>Marketplace</h1>
            <p class="hero-sub">Source yard-verified fruits &amp; vegetables at live wholesale rates. Built for retailers, distributors &amp; hospitality buyers.</p>

            <div class="hero-btns">
                <a href="#catalog" class="btn-gold-solid">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    Browse Today's Rates
                </a>
                <a href="#" class="btn-ghost-w">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Download Daily PDF
                </a>
            </div>

            <div class="hero-stats-row">
                <div class="hero-stat">
                    <div class="hero-stat-val">2,450+</div>
                    <div class="hero-stat-lbl">Tons Ready</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">Live</div>
                    <div class="hero-stat-lbl">Mandi Pricing</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">100%</div>
                    <div class="hero-stat-lbl">Quality Assured</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">500+</div>
                    <div class="hero-stat-lbl">Buyers Served</div>
                </div>
            </div>
        </div>

        {{-- Right Column: Highlights card (desktop only) --}}
        <div class="hl-box">
            <div class="hl-header">
                <h3>Market Highlights</h3>
                <span class="live-badge"><span class="live-dot"></span>LIVE</span>
            </div>
            <div class="ticker-item">
                <div class="ti-icon down"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg></div>
                <div><div class="ti-title">Onion (Nashik) Dropped ↓4%</div><div class="ti-desc">Massive fresh arrivals from mandi yards</div></div>
            </div>
            <div class="ticker-item">
                <div class="ti-icon up"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg></div>
                <div><div class="ti-title">Tomato Supply Tight ↑2%</div><div class="ti-desc">Book bulk orders early to secure rates</div></div>
            </div>
            <div class="ticker-item">
                <div class="ti-icon star"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></div>
                <div><div class="ti-title">Kashmiri Apples Available</div><div class="ti-desc">Grade A cold storage stock arrived</div></div>
            </div>
            <div class="ticker-item">
                <div class="ti-icon up"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg></div>
                <div><div class="ti-title">Dragon Fruit — New Arrival</div><div class="ti-desc">Exotic produce, limited quantity only</div></div>
            </div>
        </div>

    </div>
</div>

{{-- ══════════════════════════════════════════════════
     MOBILE-ONLY: Market Highlights Strip (below banner)
══════════════════════════════════════════════════ --}}
<div class="mobile-hl-strip">
    <div class="mhl-card">
        <div class="mhl-icon down"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg></div>
        <div><div class="mhl-t">Onion ↓4%</div><div class="mhl-d">Nashik fresh arrivals</div></div>
    </div>
    <div class="mhl-card">
        <div class="mhl-icon up"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg></div>
        <div><div class="mhl-t">Tomato ↑2%</div><div class="mhl-d">Book bulk now</div></div>
    </div>
    <div class="mhl-card">
        <div class="mhl-icon star"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></div>
        <div><div class="mhl-t">Kashmiri Apples</div><div class="mhl-d">Grade A cold storage</div></div>
    </div>
    <div class="mhl-card">
        <div class="mhl-icon up"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg></div>
        <div><div class="mhl-t">Dragon Fruit ★</div><div class="mhl-d">Exotic — limited qty</div></div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════
     CATALOG SECTION
══════════════════════════════════════════════════ --}}
<div class="container" style="padding: 48px 0 64px;" id="catalog">

    @if(session('success'))
        <div style="background:#059669;color:#fff;padding:12px 16px;border-radius:8px;font-weight:600;font-size:13px;margin-bottom:24px;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Categories --}}
    <div class="section-title">
        Browse by Category
        <a href="{{ route('categories') }}">View All &rarr;</a>
    </div>
    <div class="cat-grid">
        <a href="#" class="cat-card">
            <div class="cat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg></div>
            <div class="cat-name">Root Vegetables</div>
            <div class="cat-count">14 Commodities</div>
        </a>
        <a href="#" class="cat-card">
            <div class="cat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg></div>
            <div class="cat-name">Fresh Fruits</div>
            <div class="cat-count">24 Commodities</div>
        </a>
        <a href="#" class="cat-card">
            <div class="cat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg></div>
            <div class="cat-name">Leafy Greens</div>
            <div class="cat-count">8 Commodities</div>
        </a>
        <a href="#" class="cat-card">
            <div class="cat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
            <div class="cat-name">Exotic Produce</div>
            <div class="cat-count">12 Commodities</div>
        </a>
    </div>

    {{-- Product Chips --}}
    <div class="section-title">Today's Mandi Rates</div>
    <div class="cat-scroll-wrap" style="margin-bottom: 20px;">
        <div class="cat-chip active">All Commodities</div>
        <div class="cat-chip">Vegetables</div>
        <div class="cat-chip">Fruits</div>
        <div class="cat-chip">Onion</div>
        <div class="cat-chip">Potato</div>
        <div class="cat-chip">Tomato</div>
        <div class="cat-chip">Organic</div>
        <div class="cat-chip">Seasonal</div>
    </div>

    {{-- Product Cards --}}
    <div class="card-grid">
        @foreach($products as $product)
        <div class="p-card">
            <a href="{{ route('product.show', $product->id) }}" style="text-decoration:none;color:inherit;display:flex;flex-direction:column;flex:1;">
                <div class="media">
                    @if($product->image_url)
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--forest);color:var(--gold);">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                    @endif
                    <div class="badge-top {{ $product->stock_status == 'SOLD_OUT' ? 'out' : '' }}">Grade {{ $product->grade ?? 'A' }}</div>
                    <div class="verified-badge">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Verified
                    </div>
                </div>
                <div class="body">
                    <div class="name">{{ $product->name }}</div>
                    <div class="meta-row">
                        <span class="moq-pill">MOQ: {{ $product->min_order_qty + 0 }} {{ $product->unit }}</span>
                        <span class="stock-pill {{ $product->stock_status == 'SOLD_OUT' ? 'out' : 'in' }}">
                            <span class="stock-dot"></span>
                            {{ $product->stock_status == 'SOLD_OUT' ? 'Out of Stock' : 'In Stock' }}
                        </span>
                    </div>
                    <div class="bottom">
                        <div class="price">₹{{ number_format($product->price_per_unit, 2) }} <small>/ {{ $product->unit }}</small></div>
                    </div>
                </div>
            </a>
            <div class="card-form-wrapper" style="padding:0 16px 16px;">
                <form action="{{ route('cart.add') }}" method="POST" style="margin:0;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="qty-wrapper">
                        <button type="button" class="qty-btn" onclick="this.nextElementSibling.stepDown()">−</button>
                        <input type="number" class="qty-input" name="quantity" value="{{ $product->min_order_qty + 0 }}" min="{{ $product->min_order_qty + 0 }}">
                        <button type="button" class="qty-btn" onclick="this.previousElementSibling.stepUp()">+</button>
                    </div>
                    <button type="submit" class="add-fab" {{ $product->stock_status==='SOLD_OUT'?'disabled':'' }}>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>

{{-- ══════════════════════════════════════════════════
     STATS STRIP
══════════════════════════════════════════════════ --}}
<div class="stats-strip">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-num" data-target="2450">0</div>
            <div class="stat-label">Tons Available Daily</div>
        </div>
        <div class="stat-item">
            <div class="stat-num" data-target="500">0</div>
            <div class="stat-label">Registered B2B Buyers</div>
        </div>
        <div class="stat-item">
            <div class="stat-num" data-target="48">0</div>
            <div class="stat-label">Commodity Varieties</div>
        </div>
        <div class="stat-item">
            <div class="stat-num" data-target="12">0</div>
            <div class="stat-label">Partner Mandi Yards</div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════════════════ --}}
<div class="hiw-section">
    <div style="text-align:center;">
        <div class="home-eyebrow" style="display:inline-flex;">Simple B2B Process</div>
        <h2 class="home-section-title">How MandIPrime Works</h2>
        <p class="home-section-sub">From browsing live rates to doorstep delivery — order wholesale fresh produce in 3 simple steps.</p>
    </div>
    <div class="hiw-grid">
        <div class="hiw-card">
            <div class="hiw-step-num">1</div>
            <div class="hiw-icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <div class="hiw-title">Browse Live Mandi Rates</div>
            <div class="hiw-desc">Check real-time prices from verified mandi yards. Filter by commodity, grade, and minimum order quantity to find exactly what your business needs.</div>
        </div>
        <div class="hiw-card">
            <div class="hiw-step-num">2</div>
            <div class="hiw-icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </div>
            <div class="hiw-title">Place a Purchase Order</div>
            <div class="hiw-desc">Add items to your cart, set quantity, and submit your purchase order. Our trade desk reviews and confirms availability within the hour.</div>
        </div>
        <div class="hiw-card">
            <div class="hiw-step-num">3</div>
            <div class="hiw-icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            </div>
            <div class="hiw-title">Receive at Your Doorstep</div>
            <div class="hiw-desc">Grade-verified, freshly dispatched produce arrives directly from cold storage or mandi yard to your facility — tracked end to end.</div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════
     WHY CHOOSE US
══════════════════════════════════════════════════ --}}
<div class="why-section">
    <div class="why-inner">
        <div style="text-align:center;">
            <div class="home-eyebrow" style="display:inline-flex; background:rgba(217,164,65,0.15); border-color:rgba(217,164,65,0.3); color:#D9A441;">Our Advantage</div>
            <h2 class="home-section-title" style="color:white;">Why Buyers Choose MandIPrime</h2>
            <p class="home-section-sub" style="color:rgba(255,255,255,0.55); margin-bottom:0;">Everything you need to run a seamless wholesale produce business — in one platform.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></div>
                <div class="why-title">Live Mandi Rate Engine</div>
                <div class="why-desc">Prices updated in real-time from partner mandi yards across Maharashtra, Karnataka, and UP. Never overpay again.</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                <div class="why-title">Grade-Verified Quality</div>
                <div class="why-desc">Every lot is quality-graded at the yard by our inspectors before dispatch. Guaranteed fresh, no rejections.</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></div>
                <div class="why-title">Same-Day Dispatch</div>
                <div class="why-desc">Orders placed before 10 AM are dispatched the same day from our cold storage facilities with end-to-end tracking.</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
                <div class="why-title">Wholesale Credit Terms</div>
                <div class="why-desc">Registered buyers get flexible 7–15 day credit terms with GST invoicing, TDS compliance, and digital payment support.</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                <div class="why-title">Dedicated Trade Desk</div>
                <div class="why-desc">Your personal trade manager handles bulk negotiations, seasonal procurement, and custom sourcing requests — Mon to Sat.</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                <div class="why-title">GST & Compliance Ready</div>
                <div class="why-desc">All orders come with proper GST invoices, Agmark certifications, and FSSAI-compliant documentation for retail and HoReCa buyers.</div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════
     TESTIMONIALS
══════════════════════════════════════════════════ --}}
<div class="testi-section">
    <div style="text-align:center;">
        <div class="home-eyebrow" style="display:inline-flex;">Trusted by Buyers</div>
        <h2 class="home-section-title">What Our Clients Say</h2>
        <p class="home-section-sub">Hundreds of retailers, distributors, and hotel chains across India rely on MandIPrime every day.</p>
    </div>
    <div class="testi-grid">
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <div class="testi-quote">"MandIPrime has completely transformed how we source produce. The live pricing saves us ₹40,000+ per month in unnecessary markups from commission agents."</div>
            <div class="testi-author">
                <div class="testi-avatar" style="background:linear-gradient(135deg,#0F3326,#1a5c40);">RK</div>
                <div>
                    <div class="testi-name">Rajesh Kumar</div>
                    <div class="testi-role">Owner, Kumar Fresh Mart · Mumbai</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <div class="testi-quote">"The quality grading system is excellent. We run 3 hotel kitchens and now source all our vegetables through MandIPrime — zero rejections in 6 months."</div>
            <div class="testi-author">
                <div class="testi-avatar" style="background:linear-gradient(135deg,#7c3aed,#5b21b6);">SP</div>
                <div>
                    <div class="testi-name">Sneha Patil</div>
                    <div class="testi-role">Purchase Head, Spice Route Hotels · Pune</div>
                </div>
            </div>
        </div>
        <div class="testi-card">
            <div class="testi-stars">★★★★☆</div>
            <div class="testi-quote">"Same-day dispatch is a game changer. Ordered onions at 8 AM, got delivery by 3 PM. The credit terms also help manage our working capital smoothly."</div>
            <div class="testi-author">
                <div class="testi-avatar" style="background:linear-gradient(135deg,#dc2626,#991b1b);">MA</div>
                <div>
                    <div class="testi-name">Mohammed Arif</div>
                    <div class="testi-role">Distributor, Arif Wholesale · Nagpur</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════
     CALL TO ACTION BANNER
══════════════════════════════════════════════════ --}}
<div class="cta-banner">
    <h2>Ready to Buy at Mandi Prices?</h2>
    <p>Join 500+ retailers and businesses already saving on wholesale fresh produce.</p>
    <div class="cta-btns">
        <a href="{{ route('register') }}" class="cta-btn-dark">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            Register as a Buyer
        </a>
        <a href="{{ route('contact') }}" class="cta-btn-outline">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            Talk to Trade Desk
        </a>
    </div>
</div>

<script>
// Animated counter for stats
(function() {
    function animateCounter(el) {
        var target = parseInt(el.getAttribute('data-target'));
        var duration = 1800;
        var start = null;
        function step(ts) {
            if (!start) start = ts;
            var progress = Math.min((ts - start) / duration, 1);
            var ease = 1 - Math.pow(1 - progress, 3);
            el.textContent = (Math.floor(ease * target)).toLocaleString('en-IN');
            if (progress < 1) requestAnimationFrame(step);
            else el.textContent = target.toLocaleString('en-IN');
        }
        requestAnimationFrame(step);
    }
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });
    document.querySelectorAll('.stat-num[data-target]').forEach(function(el) {
        observer.observe(el);
    });
})();
</script>

@endsection
