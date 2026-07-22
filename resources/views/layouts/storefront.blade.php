<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandi Prime</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#F3F4F6;
            --surface:#FFFFFF;
            --ink:#111827;
            --ink-soft:#4B5563;
            --ink-faint:#9CA3AF;
            --forest:#0F3326;
            --forest-2:#0B241A;
            --gold:#D9A441;
            --gold-soft:#FEF3C7;
            --line:#E5E7EB;
            --line-strong:#D1D5DB;
            --danger:#DC2626;
            --success:#166534;
            --radius:8px;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        }
        *{ box-sizing:border-box; }
        html,body{ margin:0; padding:0; }
        body{
            background:var(--bg);
            color:var(--ink);
            font-family:'Inter', sans-serif;
            -webkit-font-smoothing:antialiased;
            font-feature-settings:"tnum" 1, "cv11" 1;
        }
        .serif{ font-family:'Inter', sans-serif; }
        a{ color:inherit; text-decoration:none; }
        img{ max-width:100%; display:block; }
        button{ font-family:inherit; }

        /* ---------------- Layout shells ---------------- */
        .container{ max-width:1180px; margin:0 auto; padding:0 28px; }
        @media (max-width:640px){ .container{ padding:0 18px; } }

        /* ---------------- Top navigation ---------------- */
        .nav{
            position:sticky; top:0; z-index:60;
            background:rgba(245,247,243,0.85);
            backdrop-filter:blur(10px);
            border-bottom:1px solid var(--line);
        }
        .nav-inner{
            max-width:1180px; margin:0 auto; padding:16px 28px;
            display:flex; align-items:center; justify-content:space-between; gap:24px;
        }
        .brand{ display:flex; align-items:center; gap:10px; }
        .brand .seal{
            width:36px; height:36px; border-radius:50%;
            background:var(--forest);
            display:flex; align-items:center; justify-content:center;
            position:relative;
        }
        .brand .seal svg{ width:18px; height:18px; }
        .brand .word{ font-size:19px; letter-spacing:-0.01em; font-weight:600; }
        .brand .word em{ font-style:normal; color:var(--gold); font-family:'Fraunces', serif; }

        .nav-links{ display:flex; align-items:center; gap:30px; font-size:14px; color:var(--ink-soft); }
        .nav-links a{ position:relative; padding:6px 0; }
        .nav-links a.active{ color:var(--ink); font-weight:600; }
        .nav-links a.active::after{
            content:""; position:absolute; left:0; right:0; bottom:-3px; height:2px; background:var(--gold); border-radius:2px;
        }
        @media (max-width:900px){ 
            .nav-inner { flex-wrap: wrap; }
            .nav-links { order: 3; width: 100%; justify-content: center; gap: 15px; margin-top: 10px; font-size: 13px; }
        }

        .nav-actions{ display:flex; align-items:center; gap:16px; }
        .icon-pill{
            width:38px; height:38px; border-radius:50%; background:var(--surface); border:1px solid var(--line-strong);
            display:flex; align-items:center; justify-content:center; position:relative; box-shadow:var(--shadow-sm);
        }
        .icon-pill .dot{
            position:absolute; top:-3px; right:-3px; width:16px; height:16px; border-radius:50%;
            background:var(--gold); color:var(--forest); font-size:9.5px; font-weight:700;
            display:flex; align-items:center; justify-content:center; border:2px solid var(--bg);
        }
        .btn{
            display:inline-flex; align-items:center; justify-content:center; gap:8px;
            border:none; border-radius:999px; cursor:pointer; font-weight:600; font-size:14px;
            padding:12px 24px; transition:transform .15s ease, box-shadow .15s ease, background .15s ease;
        }
        .btn-primary{ background:var(--forest); color:#fff; box-shadow:var(--shadow-sm); }
        .btn-primary:hover{ background:var(--forest-2); box-shadow:var(--shadow-md); transform:translateY(-1px); }
        .btn-gold{ background:var(--gold); color:var(--forest); }
        .btn-gold:hover{ filter:brightness(1.06); transform:translateY(-1px); }
        .btn-outline{ background:transparent; border:1.5px solid var(--line-strong); color:var(--ink); }
        .btn-outline:hover{ border-color:var(--ink); }
        .btn-ghost{ background:transparent; color:var(--ink-soft); padding:10px 14px; }
        .btn-sm{ padding:9px 16px; font-size:13px; }
        .btn-block{ width:100%; }

        /* ---------------- Seal / quality badge ---------------- */
        .seal-badge{
            display:inline-flex; align-items:center; gap:8px;
            border:1px solid var(--gold); color:var(--gold);
            border-radius:999px; padding:6px 14px 6px 8px; font-size:12px; font-weight:600; letter-spacing:.02em;
            background:rgba(173,138,60,0.06);
        }
        .seal-badge .ring{
            width:20px; height:20px; border-radius:50%; border:1.5px solid var(--gold);
            display:flex; align-items:center; justify-content:center; font-size:10px;
        }

        /* ---------------- Section headings ---------------- */
        .eyebrow{ font-size:12px; letter-spacing:.14em; text-transform:uppercase; color:var(--gold); font-weight:700; }
        h1,h2,h3{ margin:0; }
        .section-head{ display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:24px; flex-wrap:wrap; }
        .section-head h2{ font-size:28px; font-family:'Fraunces', serif; font-weight:600; }
        .section-head .see-all{ font-size:13.5px; color:var(--ink-soft); font-weight:600; }

        /* ---------------- Product cards ---------------- */
        .card-grid{ display:grid; grid-template-columns:repeat(4, 1fr); gap:24px; }
        @media (max-width:1020px){ .card-grid{ grid-template-columns:repeat(3,1fr); } }
        @media (max-width:720px){ .card-grid{ grid-template-columns:repeat(2,1fr); gap:16px; } }

        .p-card {
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid rgba(15, 51, 38, 0.08);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .p-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(15, 51, 38, 0.09);
            border-color: rgba(15, 51, 38, 0.15);
        }
        .p-card .media {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: #f7f9f6;
            overflow: hidden;
        }
        .p-card .media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .p-card:hover .media img {
            transform: scale(1.06);
        }
        .p-card .badge-top {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            background: rgba(15, 51, 38, 0.85);
            color: white;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            z-index: 2;
        }
        .p-card .badge-top.out {
            background: rgba(220, 38, 38, 0.9);
            border-color: rgba(220, 38, 38, 0.2);
            color: white;
        }
        .p-card .verified-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            color: #16a34a;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            z-index: 2;
        }
        .p-card .body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }
        .p-card .name {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 44px;
            text-decoration: none;
        }
        .p-card .meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
        }
        .p-card .moq-pill {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--ink-soft);
            background: #f3f4f6;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-block;
        }
        .p-card .stock-pill {
            font-size: 11.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .p-card .stock-pill.in { color: #16a34a; }
        .p-card .stock-pill.out { color: var(--danger); }
        .p-card .stock-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        .p-card .stock-pill.in .stock-dot {
            background: #16a34a;
            box-shadow: 0 0 8px #16a34a;
            animation: pulse-dot 1.5s infinite;
        }
        .p-card .stock-pill.out .stock-dot {
            background: var(--danger);
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }
        .p-card .bottom {
            margin-top: 8px;
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .p-card .price {
            font-size: 20px;
            font-weight: 800;
            color: var(--forest);
        }
        .p-card .price small {
            font-size: 12px;
            font-weight: 500;
            color: var(--ink-soft);
        }
        .p-card .qty-wrapper {
            display: flex;
            align-items: center;
            border: 1.5px solid rgba(15, 51, 38, 0.15);
            border-radius: 10px;
            overflow: hidden;
            height: 38px;
            background: var(--surface);
            transition: border-color 0.2s;
        }
        .p-card .qty-wrapper:focus-within {
            border-color: var(--forest);
        }
        .p-card .qty-btn {
            border: none;
            background: transparent;
            width: 36px;
            height: 100%;
            cursor: pointer;
            font-size: 18px;
            font-weight: 700;
            color: var(--forest);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }
        .p-card .qty-btn:hover {
            background: rgba(15, 51, 38, 0.05);
        }
        .p-card .qty-input {
            width: 44px;
            border: none;
            border-left: 1px solid rgba(15, 51, 38, 0.1);
            border-right: 1px solid rgba(15, 51, 38, 0.1);
            text-align: center;
            font-weight: 700;
            font-size: 13.5px;
            height: 100%;
            background: transparent;
            color: var(--ink);
            -moz-appearance: textfield;
            padding: 0;
        }
        .p-card .qty-input::-webkit-outer-spin-button,
        .p-card .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .p-card .add-fab {
            flex: 1;
            height: 38px;
            border-radius: 10px;
            background: var(--forest);
            color: white;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13.5px;
            font-weight: 700;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(15, 51, 38, 0.15);
            transition: all 0.2s;
        }
        .p-card .add-fab:hover {
            background: var(--forest-2);
            box-shadow: 0 6px 16px rgba(15, 51, 38, 0.25);
            transform: translateY(-1px);
        }
        .p-card .add-fab:disabled {
            background: #d1d5db;
            color: #9ca3af;
            cursor: not-allowed;
            box-shadow: none;
        }


        /* ---------------- Category tiles ---------------- */
        .cat-grid{ display:grid; grid-template-columns:repeat(4,1fr); gap:16px; }
        @media (max-width:760px){ .cat-grid{ grid-template-columns:repeat(2,1fr); } }
        .cat-tile{
            border-radius:var(--radius); padding:22px; min-height:110px; position:relative; overflow:hidden;
            display:flex; flex-direction:column; justify-content:flex-end; box-shadow:var(--shadow-sm);
            border:1px solid var(--line);
        }
        .cat-tile .icon{ font-size:30px; margin-bottom:8px; }
        .cat-tile .lbl{ font-weight:600; font-size:15px; }
        .cat-tile .count{ font-size:12px; color:var(--ink-soft); }

        /* ---------------- Forms ---------------- */
        .field{ margin-bottom:16px; }
        .field label{ display:block; font-size:13px; font-weight:600; margin-bottom:6px; color:var(--ink-soft); }
        .field input, .field select{
            width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--line-strong);
            background:var(--surface); font-size:14.5px; color:var(--ink); font-family:inherit;
        }
        .field input:focus, .field select:focus{ outline:none; border-color:var(--gold); box-shadow:0 0 0 3px rgba(173,138,60,0.15); }

        /* ---------------- Misc ---------------- */
        .divider-dashed{ border-top:1px dashed var(--line-strong); }
        .footer{ border-top:1px solid var(--line); padding:36px 0; margin-top:60px; }
        .footer .container{ display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px; }
        .footer .cols{ font-size:12.5px; color:var(--ink-faint); }

        .hero{ padding:64px 0 56px; overflow:hidden; }
        .hero-grid{ display:grid; grid-template-columns:1.1fr 0.9fr; gap:48px; align-items:center; }
        @media (max-width:900px){ .hero-grid{ grid-template-columns:1fr; } }
        .hero h1{ font-size:52px; line-height:1.05; font-weight:600; margin:14px 0 18px; letter-spacing:-0.01em; }
        .hero p.lede{ font-size:16.5px; color:var(--ink-soft); max-width:440px; margin-bottom:26px; line-height:1.6; }
        .hero-ctas{ display:flex; gap:14px; margin-bottom:30px; flex-wrap:wrap; }
        .trust-row{ display:flex; gap:28px; flex-wrap:wrap; }
        .trust-item .n{ font-size:20px; font-weight:700; font-family:'Fraunces',serif; }
        .trust-item .l{ font-size:12px; color:var(--ink-soft); }

        .hero-visual{ position:relative; }
        .collage{ display:grid; grid-template-columns:1fr 1fr; gap:14px; }
        .collage .tile{ border-radius:20px; box-shadow:var(--shadow-md); display:flex; align-items:center; justify-content:center; font-size:64px; }
        .collage .tile.a{ grid-column:1/2; grid-row:1/3; background:linear-gradient(160deg,#FBEFE0,#F3D9AE); height:280px; }
        .collage .tile.b{ background:linear-gradient(160deg,#E8F1E5,#CFE6C7); height:130px; }
        .collage .tile.c{ background:linear-gradient(160deg,#F6E2C8,#EFC9A0); height:130px; }
        .float-badge{
            position:absolute; bottom:-18px; left:18px; background:var(--surface); border-radius:14px; padding:12px 16px;
            box-shadow:var(--shadow-lg); display:flex; align-items:center; gap:10px; font-size:13px; font-weight:600;
        }
        .float-badge .ring{ width:30px;height:30px;border-radius:50%; background:var(--gold-soft); color:var(--gold); display:flex;align-items:center;justify-content:center; font-size:15px; }

        .section{ padding:44px 0; }
        .section.tint{ background:var(--surface); border-top:1px solid var(--line); border-bottom:1px solid var(--line); }

        .stats-strip{ display:flex; justify-content:space-between; gap:20px; flex-wrap:wrap; }
        .stat-block{ flex:1; min-width:160px; text-align:center; padding:22px 10px; }
        .stat-block .n{ font-family:'Fraunces',serif; font-size:34px; font-weight:600; color:var(--forest); }
        .stat-block .l{ font-size:12.5px; color:var(--ink-soft); margin-top:4px; }
        
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px; }
        .footer { padding: 60px 0 32px; margin-top: 60px; }
        .footer h4 { font-size: 14px; font-weight: 700; margin-bottom: 16px; color: var(--ink); }
        .footer-links { display: flex; flex-direction: column; gap: 12px; font-size: 13.5px; color: var(--ink-soft); }
        .footer-links a { color: var(--ink-soft); text-decoration: none; transition: color .15s; }
        .footer-links a:hover { color: var(--ink); }

        /* ── Premium Dark Footer ── */
        .site-footer { background:#061a11; color:rgba(255,255,255,.75); padding:64px 0 0; margin-top:80px; }
        .footer-top { max-width:1180px; margin:0 auto; padding:0 28px 56px; display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:48px; border-bottom:1px solid rgba(255,255,255,.08); }
        .footer-brand .brand-logo { display:flex; align-items:center; gap:10px; text-decoration:none; margin-bottom:18px; }
        .footer-brand .logo-seal { width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,#D9A441,#b8872e); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .footer-brand .logo-text { font-size:22px; font-weight:800; letter-spacing:-.5px; color:white; }
        .footer-brand .logo-text span { color:#D9A441; }
        .footer-brand p { font-size:13.5px; line-height:1.7; color:rgba(255,255,255,.5); margin:0 0 24px; max-width:280px; }
        .footer-contact-item { display:flex; align-items:center; gap:10px; font-size:13px; font-weight:600; color:rgba(255,255,255,.7); margin-bottom:12px; }
        .footer-contact-item svg { flex-shrink:0; color:#D9A441; }
        .footer-col h4 { font-size:12px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:rgba(255,255,255,.4); margin:0 0 18px; cursor:default; }
        .footer-col-links a { display:block; font-size:14px; font-weight:500; color:rgba(255,255,255,.65); text-decoration:none; padding:6px 0; transition:color .15s; }
        .footer-col-links a:hover { color:white; }
        .footer-bottom { max-width:1180px; margin:0 auto; padding:20px 28px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; font-size:12px; color:rgba(255,255,255,.3); }
        .footer-bottom-badges { display:flex; gap:20px; }

        
        /* Custom styles appended from other templates for consistency */
        .page-header{ padding:44px 0 24px; }
        .page-header p{ color:var(--ink-soft); font-size:15px; }
        
        /* ---------------- Mobile App-Like Responsive Redesign ---------------- */
        .mobile-only { display: none; }
        .desktop-search { flex: 1; max-width: 500px; }
        
        /* Horizontal Scrolling Categories (Global) */
        .cat-scroll-wrap { 
            display: flex; 
            gap: 12px; 
            overflow-x: auto; 
            padding-bottom: 12px; 
            -webkit-overflow-scrolling: touch; 
            scrollbar-width: none; /* Firefox */
        }
        .cat-scroll-wrap::-webkit-scrollbar { display: none; }
        .cat-chip {
            flex-shrink: 0;
            padding: 10px 20px;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }
        .cat-chip.active { background: var(--forest); color: white; border-color: var(--forest); }
        
        @media (max-width: 768px) {
            .hide-on-mobile { display: none !important; }
            .mobile-only { display: flex !important; }
            
            /* Remove all body overflow to prevent horizontal scrolling */
            body { overflow-x: hidden; }
            .container { padding: 0 16px; }
            .section { padding: 32px 0; }
            .hero { padding: 40px 0 32px; }
            .page-header { padding: 32px 0 16px; }
            
            /* Compact App-Like Header */
            .nav-inner { padding: 12px 16px; gap: 12px; justify-content: space-between; }
            .brand .word { display: none; }
            .brand .word.mobile-show { display: block; font-size: 20px; }
            .brand .seal { width: 36px; height: 36px; }
            .nav-actions { gap: 12px; }
            .icon-pill, .nav-actions .btn-sm { width: 44px; height: 44px; padding: 0; justify-content: center; }
            .nav-actions .btn-primary { height: 44px; font-size: 14px; padding: 0 16px; border-radius: 8px; }
            .btn-text-hide { display: none; }
            
            /* Desktop search hidden, mobile search icon shown */
            .desktop-search { display: none; }
            
            /* Strict 2-Column Product Grid */
            .card-grid { 
                grid-template-columns: repeat(2, 1fr) !important; 
                gap: 12px !important; 
            }
            
            /* Touch-optimized App-like Cards */
            .p-card { border-radius: 16px; display: flex; flex-direction: column; background: var(--surface); }
            .p-card .media { height: 140px; }
            .p-card .body { padding: 12px; display: flex; flex-direction: column; gap: 4px; }
            .p-card .name { font-size: 13.5px; line-height: 1.3; margin-bottom: 2px; height: auto; min-height: auto; max-height: 36px; }
            .p-card .meta-row { flex-direction: column; align-items: flex-start; gap: 4px; margin-top: 2px; }
            .p-card .moq-pill { font-size: 10px; padding: 2px 6px; }
            .p-card .stock-pill { font-size: 10px; }
            .p-card .bottom { padding-top: 4px; margin-top: 4px; border: none; display: flex; }
            .p-card .price { font-size: 16px; font-weight: 800; }
            .p-card .price small { font-size: 10.5px; }
            
            /* Mobile Forms & Buttons inside Card */
            .p-card form { display: flex; flex-direction: row; gap: 8px; width: 100%; align-items: center; }
            .p-card .qty-wrapper { height: 34px; flex: 1.1; justify-content: space-between; border-radius: 8px; }
            .qty-wrapper .qty-btn { width: 28px; font-size: 15px; }
            .qty-wrapper .qty-input { flex: 1; font-size: 12.5px; width: 28px; }
            .p-card .add-fab { height: 34px; border-radius: 8px; font-size: 12.5px; font-weight: 700; flex: 0.9; display: flex; gap: 4px; margin-top: 0; box-shadow: none; }


            
            /* Typography optimizations */
            h1 { font-size: 32px !important; line-height: 1.2 !important; }
            .section-head h2 { font-size: 22px; }
            .hero p.lede { font-size: 15px; line-height: 1.6; margin-bottom: 24px; }
            
            /* ── Footer Mobile ── */
            .site-footer { margin-top:48px; padding-top:36px; }
            .footer-top { grid-template-columns:1fr; gap:0; padding:0 20px 0; }
            .footer-brand { padding-bottom:28px; border-bottom:1px solid rgba(255,255,255,.08); }
            .footer-brand p { max-width:100%; }
            .footer-col { border-bottom:1px solid rgba(255,255,255,.08); }
            .footer-col h4 {
                display:flex; justify-content:space-between; align-items:center;
                padding:17px 0; margin:0; cursor:pointer;
                font-size:14px; font-weight:700; text-transform:none; letter-spacing:0;
                color:rgba(255,255,255,.85);
            }
            .footer-col h4 .chevron { transition:transform .25s; }
            .footer-col h4.open .chevron { transform:rotate(180deg); }
            .footer-col-links { display:none; padding-bottom:8px; }
            .footer-col-links.open { display:block; }
            .footer-col-links a { padding:9px 0; border-bottom:1px solid rgba(255,255,255,.05); font-size:14px; }
            .footer-col-links a:last-child { border-bottom:none; }
            .footer-bottom { flex-direction:column; align-items:flex-start; gap:6px; padding:20px 20px 32px; font-size:11.5px; }
            .footer-bottom-badges { gap:14px; }

            .mobile-col { flex-direction: column !important; align-items: flex-start !important; gap: 8px !important; }
        }
    </style>
</head>
<body>
<nav class="nav" style="border-bottom: 1px solid rgba(15, 51, 38, 0.08); background:#fff; box-shadow:0 2px 10px rgba(0,0,0,0.02);">
    <div class="hide-on-mobile" style="background:var(--forest); color:#fff; padding:6px 28px; font-size:12px; display:flex; justify-content:space-between;">
        <div>Mandi Prime B2B Wholesale Trading Platform | Rates updated live from the yard</div>
        <div style="display:flex; gap:16px;">
            <a href="{{ route('contact') }}">Help & Support</a>
            <a href="#">Become a Supplier</a>
        </div>
    </div>
    <div class="nav-inner" style="display:flex; align-items:center; gap:30px;">
        <a href="{{ route('home') }}" class="brand" style="flex-shrink:0;">
            <div class="seal">
                <svg viewBox="0 0 24 24" width="22" height="22" stroke="var(--gold)" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <div class="word" style="font-size:20px; font-weight:800; letter-spacing:-0.5px; color:var(--forest);">MANDI<span style="color:var(--gold);">PRIME</span></div>
        </a>

        <div class="desktop-search">
            <form action="#" style="display:flex; width:100%; position:relative;">
                <input type="text" placeholder="Search for onions, potatoes, apples..." style="width:100%; padding:10px 14px 10px 40px; border:1px solid rgba(15, 51, 38, 0.15); border-radius:10px; font-size:14px; outline:none; font-family:inherit; background:#f5f7f5;">
                <svg style="position:absolute; left:12px; top:12px; color:var(--ink-soft);" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </form>
        </div>

        <div class="nav-links hide-on-mobile" style="display:flex; gap:20px; font-weight:600; font-size:13.5px;">
            <a href="{{ route('home') }}" class="{{ request()->requestUri == '/' ? 'active' : '' }}">Today's Rates</a>
            <a href="{{ route('categories') }}" class="{{ request()->routeIs('categories') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('bulk-deals') }}" class="{{ request()->routeIs('bulk-deals') ? 'active' : '' }}">Bulk Deals</a>
            <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">My Orders</a>
            <a href="{{ route('ledger') }}" class="{{ request()->routeIs('ledger') ? 'active' : '' }}">Ledger</a>
        </div>

        <div class="nav-actions" style="margin-left:auto; display:flex; align-items:center;">
            @auth
                <a href="{{ route('notifications') }}" class="icon-pill hide-on-mobile" style="border:none; box-shadow:none; background:transparent; width:auto; cursor:pointer; color:inherit;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </a>
            @endauth
            
            <a href="{{ route('cart.index') }}" class="btn-primary" style="display:flex; align-items:center; justify-content:center; gap:8px; border-radius:10px; text-decoration:none; font-weight:700; font-size:13px; height:38px; padding:0 14px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                <span class="btn-text-hide">PO Cart</span>
                @if(session()->has('cart') && count(session('cart')) > 0)
                    <span style="background:var(--gold); color:var(--forest); padding:2px 6px; border-radius:4px; font-size:11px; margin-left:4px; font-weight:800;">{{ count(session('cart')) }}</span>
                @endif
            </a>

            @auth
                @if(Auth::user()->role === 'ADMIN')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm hide-on-mobile" style="background:var(--forest); color:white; border-color:var(--forest); border-radius:8px;">Admin</a>
                @endif
                <a href="{{ route('profile.edit') }}" style="display:flex; align-items:center; gap:8px; text-decoration:none; color:inherit; font-weight:600; font-size:13px;" title="My Profile">
                    <div style="width:34px; height:34px; background:var(--gold-soft); color:var(--forest); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; margin-left:6px; border:1.5px solid rgba(15, 51, 38, 0.15);">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline btn-sm" style="border-radius:8px; margin-left:6px; padding:8px 16px;">Login</a>
            @endauth
        </div>
    </div>
    
    {{-- Permanent app-like search bar below header on mobile only --}}
    <div class="mobile-only" style="padding: 0 16px 12px 16px; background:#fff;">
        <form action="#" style="display:flex; width:100%; position:relative; margin:0;">
            <input type="text" placeholder="Search onions, tomatoes, potatoes, apples..." style="width:100%; padding:10px 14px 10px 38px; border:1px solid rgba(15, 51, 38, 0.12); border-radius:10px; background:#f3f4f6; font-size:13.5px; outline:none; font-family:inherit; color:var(--ink);">
            <svg style="position:absolute; left:12px; top:12px; color:var(--ink-soft);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </form>
    </div>
</nav>

@yield('content')

<footer class="site-footer">
    <div class="footer-top">


        {{-- Brand --}}
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="brand-logo">
                <div class="logo-seal">
                    <svg viewBox="0 0 24 24" width="22" height="22" stroke="white" stroke-width="2" fill="none"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <div class="logo-text">MANDI<span>PRIME</span></div>
            </a>
            <p>India's leading B2B wholesale platform for fresh produce. Connecting trusted mandi suppliers directly with enterprise buyers, retailers &amp; hospitality businesses.</p>
            <div class="footer-contact-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                Trade Desk: 1800-MANDI-B2B
            </div>
            <div class="footer-contact-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Mon â€“ Sat &nbsp;Â·&nbsp; 4:00 AM to 2:00 PM
            </div>
        </div>

        {{-- Platform --}}
        <div class="footer-col">
            <h4 onclick="toggleFCol(this)">
                Platform
                <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </h4>
            <div class="footer-col-links">
                <a href="{{ route('about') }}">About Company</a>
                <a href="#">Wholesale Process</a>
                <a href="#">Become a Buyer</a>
                <a href="#">Business Registration</a>
                <a href="#">Logistics Partners</a>
            </div>
        </div>

        {{-- Legal --}}
        <div class="footer-col">
            <h4 onclick="toggleFCol(this)">
                Legal &amp; Trust
                <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </h4>
            <div class="footer-col-links">
                <a href="#">GST Information</a>
                <a href="#">Terms of Trade</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Quality Guarantee</a>
                <a href="#">Dispute Resolution</a>
            </div>
        </div>

        {{-- Facilities --}}
        <div class="footer-col">
            <h4 onclick="toggleFCol(this)">
                Facilities
                <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </h4>
            <div class="footer-col-links">
                <a href="#">Central Warehouse</a>
                <a href="#">Cold Storage Units</a>
                <a href="#">Dispatch Center</a>
                <a href="#">Supplier Portal</a>
                <a href="{{ route('contact') }}">Help &amp; Support</a>
            </div>
        </div>

    </div>
    <div class="footer-bottom">
        <div>&copy; {{ date('Y') }} Mandi Prime Wholesale Trading Pvt. Ltd. All rights reserved.</div>
        <div class="footer-bottom-badges">
            <span>GSTIN: 27AADCMXXXXX1Z3</span>
            <span>FSSAI: 115210XXXXX012</span>
        </div>
    </div>
</footer>

<script>
function toggleFCol(h4) {
    h4.classList.toggle('open');
    h4.nextElementSibling.classList.toggle('open');
}
(function() {
    function setMode() {
        var mobile = window.innerWidth <= 768;
        document.querySelectorAll('.footer-col-links').forEach(function(el) {
            if (!mobile) { el.style.display = 'block'; }
            else { el.style.display = el.classList.contains('open') ? 'block' : 'none'; }
        });
        document.querySelectorAll('.footer-col h4 .chevron').forEach(function(el) {
            el.style.display = mobile ? 'inline-block' : 'none';
        });
    }
    setMode();
    window.addEventListener('resize', setMode);
})();
</script>

</body>
</html>
