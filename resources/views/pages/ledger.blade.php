@extends('layouts.storefront')

@section('content')
<style>
.page-header { background: var(--surface); padding: 40px 0; border-bottom: 1px solid var(--line); margin-bottom: 40px; }
.page-title { font-size: 28px; font-weight: 800; color: var(--ink); margin-bottom: 8px; }

.ledger-box { background: white; border: 1px solid var(--line); border-radius: 12px; box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 80px; }
.lb-header { padding: 24px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; background: var(--bg); }
.lb-balance { font-size: 14px; color: var(--ink-soft); }
.lb-amount { font-size: 32px; font-weight: 800; color: var(--danger); }
.lb-amount.credit { color: var(--success); }

.ledger-table { width: 100%; border-collapse: collapse; }
.ledger-table th, .ledger-table td { padding: 16px 24px; text-align: left; border-bottom: 1px solid var(--line); font-size: 14px; }
.ledger-table th { background: white; font-weight: 600; color: var(--ink-soft); text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
.ledger-table td { color: var(--ink); font-weight: 500; }
.ledger-table tr:last-child td { border-bottom: none; }

.status-badge { padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; display: inline-block; }
.status-badge.paid { background: #ECFDF5; color: #059669; }
.status-badge.due { background: #FEF2F2; color: #DC2626; }

.btn-invoice { background: transparent; border: 1px solid var(--line-strong); color: var(--ink); padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
.btn-invoice:hover { background: var(--surface); }

@media (max-width: 768px) {
    .page-header { padding: 36px 0; margin-bottom: 24px; }
    .page-title { font-size: 24px; }
    .lb-header { flex-direction: column; align-items: flex-start; gap: 16px; padding: 18px; }
    .lb-header div { text-align: left !important; }
    .lb-amount { font-size: 26px; }
    .ledger-table th, .ledger-table td { padding: 12px 16px; font-size: 13px; }
}
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Financial Ledger</h1>
        <p style="color:var(--ink-soft); font-size:14px;">View your credit limit, outstanding balances, and download GST invoices.</p>
    </div>
</div>

<div class="container">
    <div class="ledger-box">
        <div class="lb-header">
            <div>
                <div class="lb-balance">Current Outstanding Balance</div>
                <div class="lb-amount {{ $balance < 0 ? 'credit' : '' }}">₹{{ number_format(abs($balance), 2) }} {{ $balance < 0 ? '(Cr)' : '(Dr)' }}</div>
            </div>
            <div style="text-align: right;">
                <div class="lb-balance" style="margin-bottom: 4px;">Approved Credit Limit</div>
                <div style="font-size: 18px; font-weight: 700; color: var(--ink);">₹{{ number_format($creditLimit, 2) }}</div>
            </div>
        </div>
        
        <div class="table-responsive" style="overflow-x: auto; width: 100%; -webkit-overflow-scrolling: touch;">
        <table class="ledger-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Transaction Ref</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entries as $entry)
                <tr>
                    <td>{{ $entry->created_at->format('M d, Y') }}</td>
                    <td>{{ $entry->reference_id }}</td>
                    <td>{{ $entry->description }}</td>
                    <td style="color: {{ $entry->type == 'CREDIT' ? 'var(--success)' : 'inherit' }};">
                         {{ $entry->type == 'CREDIT' ? '+' : '' }} ₹{{ number_format($entry->amount, 2) }}
                    </td>
                    <td>
                        @if($entry->status == 'SETTLED' || $entry->status == 'CLEARED')
                            <span class="status-badge paid">{{ $entry->status }}</span>
                        @else
                            <span class="status-badge due">{{ $entry->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if($entry->type == 'DEBIT')
                            <button class="btn-invoice"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> PDF</button>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding: 40px; color: var(--ink-soft);">No transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
