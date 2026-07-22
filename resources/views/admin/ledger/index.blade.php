@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
        Finance & Sourcing / Credit Ledger (Khata)
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Master Credit Ledger</h1>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-outline">Export Statement</button>
            <button class="btn btn-primary">+ Record Payment</button>
        </div>
    </div>
</div>

<div class="card" style="padding: 0;">
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Buyer</th>
                <th>Reference</th>
                <th>Description</th>
                <th>Debit (₹)</th>
                <th>Credit (₹)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entries as $entry)
            <tr>
                <td>{{ $entry->created_at->format('d M, Y') }}</td>
                <td style="font-weight: 600;">{{ $entry->user->name ?? 'System' }}</td>
                <td style="font-family: monospace; color: var(--ink-soft);">{{ $entry->reference_id }}</td>
                <td>{{ $entry->description }}</td>
                <td style="font-weight: 700; color: var(--danger);">
                    {{ $entry->type == 'DEBIT' ? number_format($entry->amount, 2) : '-' }}
                </td>
                <td style="font-weight: 700; color: var(--success);">
                    {{ $entry->type == 'CREDIT' ? number_format($entry->amount, 2) : '-' }}
                </td>
                <td>
                    <span class="badge {{ $entry->status == 'SETTLED' ? 'badge-success' : 'badge-warning' }}">
                        {{ $entry->status }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: var(--ink-soft);">
                    No transactions found in the ledger.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
