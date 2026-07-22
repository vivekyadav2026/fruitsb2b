@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        Overview / Dashboard
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Executive Dashboard</h1>
        <div style="display:flex; gap:12px;">
            <select style="padding: 8px 12px; border-radius: 6px; border: 1px solid var(--line-strong); font-size: 13px; font-family: inherit;">
                <option>Today</option>
                <option>Yesterday</option>
                <option>Last 7 Days</option>
                <option>This Month</option>
            </select>
            <button class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                Download Report
            </button>
        </div>
    </div>
</div>

<!-- KPI Grid -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px;">
    <div class="card" style="margin-bottom: 0;">
        <div class="card-body">
            <div style="font-size: 13px; color: var(--ink-soft); font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Today's Sales</div>
            <div style="font-size: 28px; font-weight: 800; color: var(--ink); margin-bottom: 8px;">₹1,42,500</div>
            <div style="font-size: 12px; color: var(--success); font-weight: 600; display:flex; align-items:center; gap:4px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                +14.5% vs Yesterday
            </div>
        </div>
    </div>
    <div class="card" style="margin-bottom: 0;">
        <div class="card-body">
            <div style="font-size: 13px; color: var(--ink-soft); font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Pending Orders</div>
            <div style="font-size: 28px; font-weight: 800; color: var(--ink); margin-bottom: 8px;">24</div>
            <div style="font-size: 12px; color: var(--danger); font-weight: 600; display:flex; align-items:center; gap:4px;">
                Requires Immediate Packing
            </div>
        </div>
    </div>
    <div class="card" style="margin-bottom: 0;">
        <div class="card-body">
            <div style="font-size: 13px; color: var(--ink-soft); font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Receivables</div>
            <div style="font-size: 28px; font-weight: 800; color: var(--ink); margin-bottom: 8px;">₹4,20,500</div>
            <div style="font-size: 12px; color: var(--warning); font-weight: 600; display:flex; align-items:center; gap:4px;">
                From 12 Buyers
            </div>
        </div>
    </div>
    <div class="card" style="margin-bottom: 0;">
        <div class="card-body">
            <div style="font-size: 13px; color: var(--ink-soft); font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Active Products</div>
            <div style="font-size: 28px; font-weight: 800; color: var(--ink); margin-bottom: 8px;">{{ $productCount ?? 45 }}</div>
            <div style="font-size: 12px; color: var(--ink-soft); font-weight: 600; display:flex; align-items:center; gap:4px;">
                <span class="badge badge-warning" style="padding:2px 6px;">3 Low Stock</span>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 24px;">
    <div class="card" style="margin-bottom: 0; display: flex; flex-direction: column;">
        <div class="card-header">Revenue & Order Volume (Last 7 Days)</div>
        <div class="card-body" style="flex: 1; min-height: 300px; position: relative;">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
    <div class="card" style="margin-bottom: 0; display: flex; flex-direction: column;">
        <div class="card-header">Top Selling Categories</div>
        <div class="card-body" style="flex: 1; min-height: 300px; position: relative; display:flex; align-items:center; justify-content:center;">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<!-- Tables Row -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header">
            Recent Orders
            <a href="#" style="font-size:12px; color:var(--primary); text-decoration:none;">View All</a>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Buyer</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight:600; color:var(--primary);">ORD-9023</td>
                        <td>ABC Retailers</td>
                        <td><span class="badge badge-warning">Processing</span></td>
                        <td>₹24,500</td>
                    </tr>
                    <tr>
                        <td style="font-weight:600; color:var(--primary);">ORD-9022</td>
                        <td>Taj Hotels</td>
                        <td><span class="badge badge-info">Dispatched</span></td>
                        <td>₹1,12,000</td>
                    </tr>
                    <tr>
                        <td style="font-weight:600; color:var(--primary);">ORD-9021</td>
                        <td>FreshMart</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td>₹8,450</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card" style="margin-bottom: 0;">
        <div class="card-header">
            Low Stock Alerts
            <a href="#" style="font-size:12px; color:var(--primary); text-decoration:none;">Manage Inventory</a>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight:600;">Hybrid Tomato (Premium)</td>
                        <td style="color:var(--danger); font-weight:700;">5 Crates</td>
                        <td><button class="btn btn-outline" style="padding: 4px 8px; font-size: 11px;">Create PO</button></td>
                    </tr>
                    <tr>
                        <td style="font-weight:600;">Garlic (Ooty)</td>
                        <td style="color:var(--danger); font-weight:700;">12 Kg</td>
                        <td><button class="btn btn-outline" style="padding: 4px 8px; font-size: 11px;">Create PO</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Revenue (₹)',
                data: [42000, 58000, 35000, 89000, 62000, 110000, 142500],
                borderColor: '#0F3326',
                backgroundColor: 'rgba(15, 51, 38, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Category Chart
    const ctxCat = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCat, {
        type: 'doughnut',
        data: {
            labels: ['Root Veg', 'Fresh Fruits', 'Leafy Greens', 'Exotic'],
            datasets: [{
                data: [45, 30, 15, 10],
                backgroundColor: ['#0F3326', '#D4AF37', '#10B981', '#3B82F6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
@endsection
