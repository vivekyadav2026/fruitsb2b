<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandi Prime - ERP Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg: #F8FAFC;
            --surface: #FFFFFF;
            --ink: #0F172A;
            --ink-soft: #64748B;
            --ink-faint: #94A3B8;
            --line: #E2E8F0;
            --line-strong: #CBD5E1;
            --forest: #0F3326;
            --forest-light: #1A4736;
            --gold: #D4AF37;
            --danger: #EF4444;
            --success: #10B981;
            --warning: #F59E0B;
            --primary: #3B82F6;
            
            --sidebar-width: 260px;
            --header-height: 64px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--ink); display: flex; height: 100vh; overflow: hidden; }
        
        /* Sidebar */
        .sidebar { width: var(--sidebar-width); background: var(--forest); color: rgba(255,255,255,0.7); display: flex; flex-direction: column; flex-shrink: 0; transition: width 0.3s; z-index: 50; }
        .sidebar.collapsed { width: 70px; }
        
        .sb-header { height: var(--header-height); padding: 0 20px; font-size: 18px; font-weight: 800; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: space-between; color: white;}
        .sb-header .brand { display: flex; align-items: center; gap: 10px; overflow: hidden; white-space: nowrap; }
        .sb-header .toggle { cursor: pointer; color: rgba(255,255,255,0.5); }
        .sb-header .toggle:hover { color: white; }
        
        .sb-scroll { flex: 1; overflow-y: auto; padding: 20px 0; }
        .sb-scroll::-webkit-scrollbar { width: 6px; }
        .sb-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        
        .sb-group { margin-bottom: 24px; }
        .sb-label { font-size: 11px; text-transform: uppercase; font-weight: 700; color: rgba(255,255,255,0.4); padding: 0 24px; margin-bottom: 8px; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; }
        .sidebar.collapsed .sb-label { opacity: 0; }
        
        .sb-link { display: flex; align-items: center; gap: 12px; padding: 10px 24px; color: inherit; text-decoration: none; font-weight: 500; font-size: 13.5px; transition: 0.2s; white-space: nowrap; }
        .sb-link:hover { color: white; background: rgba(255,255,255,0.05); }
        .sb-link.active { color: white; background: rgba(255,255,255,0.1); border-left: 3px solid var(--gold); padding-left: 21px; font-weight: 600; }
        .sb-icon { width: 20px; height: 20px; flex-shrink: 0; }
        
        /* Main Layout */
        .main-wrapper { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        
        /* Top Navigation */
        .topbar { height: var(--header-height); background: white; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; padding: 0 24px; z-index: 40; flex-shrink: 0; }
        .tb-left { display: flex; align-items: center; gap: 24px; flex: 1; }
        .tb-search { position: relative; width: 100%; max-width: 400px; }
        .tb-search input { width: 100%; padding: 8px 16px 8px 36px; border-radius: 6px; border: 1px solid var(--line-strong); background: var(--bg); font-size: 14px; font-family: inherit; }
        .tb-search input:focus { outline: none; border-color: var(--primary); background: white; }
        .tb-search svg { position: absolute; left: 12px; top: 9px; color: var(--ink-faint); }
        
        .tb-right { display: flex; align-items: center; gap: 16px; }
        .tb-icon-btn { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--ink-soft); cursor: pointer; transition: 0.2s; position: relative; }
        .tb-icon-btn:hover { background: var(--bg); color: var(--ink); }
        .tb-badge { position: absolute; top: 4px; right: 4px; width: 8px; height: 8px; background: var(--danger); border-radius: 50%; border: 2px solid white; }
        
        .tb-profile { display: flex; align-items: center; gap: 10px; cursor: pointer; padding-left: 16px; border-left: 1px solid var(--line); }
        .tb-avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--forest); color: white; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; }
        
        /* Content Area */
        .content-scroll { flex: 1; overflow-y: auto; padding: 32px; }
        .page-header-wrap { margin-bottom: 24px; }
        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--ink-soft); margin-bottom: 8px; }
        .breadcrumb svg { width: 14px; height: 14px; }
        .page-title { font-size: 24px; font-weight: 700; color: var(--ink); }
        
        /* UI Components */
        .card { background: white; border: 1px solid var(--line); border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px; }
        .card-header { padding: 16px 20px; border-bottom: 1px solid var(--line); font-weight: 600; display: flex; justify-content: space-between; align-items: center; }
        .card-body { padding: 20px; }
        
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 20px; text-align: left; border-bottom: 1px solid var(--line); font-size: 13.5px; }
        .table th { font-weight: 600; color: var(--ink-soft); background: var(--bg); text-transform: uppercase; font-size: 11.5px; letter-spacing: 0.5px; }
        .table tr:last-child td { border-bottom: none; }
        .table tr:hover td { background: var(--bg); }
        
        .btn { padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 13px; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; font-family: inherit; transition: 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: #2563EB; }
        .btn-forest { background: var(--forest); color: white; }
        .btn-forest:hover { background: var(--forest-light); }
        .btn-outline { background: white; border: 1px solid var(--line-strong); color: var(--ink); }
        .btn-outline:hover { background: var(--bg); }
        
        .badge { display: inline-flex; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; }
        .badge-success { background: #DCFCE7; color: #166534; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-danger { background: #FEE2E2; color: #991B1B; }
        .badge-info { background: #DBEAFE; color: #1E40AF; }
        .badge-gray { background: #F1F5F9; color: #475569; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sb-header">
            <div class="brand">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                <span>ERP Admin</span>
            </div>
            <div class="toggle" onclick="document.getElementById('sidebar').classList.toggle('collapsed')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </div>
        </div>
        
        <div class="sb-scroll">
            <div class="sb-group">
                <div class="sb-label">Overview</div>
                <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.reports') }}" class="sb-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                    Reports & Analytics
                </a>
            </div>
            
            <div class="sb-group">
                <div class="sb-label">Catalog & Inventory</div>
                <a href="{{ route('admin.products') }}" class="sb-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    Products
                </a>
                <a href="{{ route('admin.rates') }}" class="sb-link {{ request()->routeIs('admin.rates') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                    Today's Mandi Rates
                </a>
                <a href="{{ route('admin.categories') }}" class="sb-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    Categories
                </a>
                <a href="{{ route('admin.inventory') }}" class="sb-link {{ request()->routeIs('admin.inventory') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    Inventory / Warehouse
                </a>
            </div>

            <div class="sb-group">
                <div class="sb-label">Sales & CRM</div>
                <a href="{{ route('admin.orders') }}" class="sb-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    Orders
                </a>
                <a href="{{ route('admin.sales') }}" class="sb-link {{ request()->routeIs('admin.sales') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    Sales History
                </a>
                <a href="{{ route('admin.buyers') }}" class="sb-link {{ request()->routeIs('admin.buyers') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Buyers / Customers
                </a>
            </div>

            <div class="sb-group">
                <div class="sb-label">Logistics</div>
                <a href="{{ route('admin.dispatch') }}" class="sb-link {{ request()->routeIs('admin.dispatch') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    Dispatch Queue
                </a>
                <a href="{{ route('admin.delivery') }}" class="sb-link {{ request()->routeIs('admin.delivery') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    Delivery Tracking
                </a>
                <a href="{{ route('admin.returns') }}" class="sb-link {{ request()->routeIs('admin.returns') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg>
                    Returns & Damage
                </a>
            </div>

            <div class="sb-group">
                <div class="sb-label">Finance & Sourcing</div>
                <a href="{{ route('admin.ledger') }}" class="sb-link {{ request()->routeIs('admin.ledger') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    Credit Ledger (Khata)
                </a>
                <a href="{{ route('admin.payments') }}" class="sb-link {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    Payments
                </a>
                <a href="{{ route('admin.invoices') }}" class="sb-link {{ request()->routeIs('admin.invoices') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Invoices
                </a>
                <a href="{{ route('admin.po') }}" class="sb-link {{ request()->routeIs('admin.po') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                    Purchase Orders
                </a>
                <a href="{{ route('admin.suppliers') }}" class="sb-link {{ request()->routeIs('admin.suppliers') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    Suppliers
                </a>
            </div>
            
            <div class="sb-group">
                <div class="sb-label">System & Admin</div>
                <a href="{{ route('admin.cms') }}" class="sb-link {{ request()->routeIs('admin.cms') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    Website CMS
                </a>
                <a href="{{ route('admin.employees') }}" class="sb-link {{ request()->routeIs('admin.employees') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Employees
                </a>
                <a href="{{ route('admin.roles') }}" class="sb-link {{ request()->routeIs('admin.roles') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    Roles & Permissions
                </a>
                <a href="{{ route('admin.settings') }}" class="sb-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    Settings
                </a>
            </div>
            
            <div style="padding: 24px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:rgba(255,255,255,0.7); display:flex; align-items:center; gap:12px; font-weight:600; font-size:13px; cursor:pointer;">
                        <svg class="sb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-wrapper">
        <div class="topbar">
            <div class="tb-left">
                <div class="tb-search">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" placeholder="Search orders, products, buyers or settings (Ctrl+K)">
                </div>
            </div>
            
            <div class="tb-right">
                <a href="{{ route('home') }}" target="_blank" class="tb-icon-btn" title="View Storefront">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </a>
                <div class="tb-icon-btn" title="Notifications">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <div class="tb-badge"></div>
                </div>
                <div class="tb-profile">
                    <div style="text-align: right;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--ink);">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div style="font-size: 11px; color: var(--ink-soft);">Super Admin</div>
                    </div>
                    <div class="tb-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-scroll">
            @yield('content')
        </div>
    </div>
</body>
</html>
