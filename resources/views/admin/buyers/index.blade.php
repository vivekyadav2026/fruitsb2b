@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        Sales & CRM / Buyers
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Manage Buyers</h1>
        <div style="display:flex; gap:12px;">
            <button class="btn btn-outline">Export CSV</button>
            <button class="btn btn-primary">+ Add Buyer</button>
        </div>
    </div>
</div>

<div class="card" style="padding: 0;">
    <table class="table">
        <thead>
            <tr>
                <th>Business Name</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Ledger Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($buyers as $buyer)
            <tr>
                <td>
                    <div style="font-weight: 600; font-size:14.5px;">{{ $buyer->name }}</div>
                    <div style="font-size: 11px; color: var(--ink-soft); font-weight: 600; margin-top:2px;">ID: B2B-{{ 1000 + $buyer->id }}</div>
                </td>
                <td>
                    <div>{{ $buyer->email }}</div>
                    <div style="font-size: 11px; color: var(--ink-soft);">+91 9XXXX XXXXX</div>
                </td>
                <td>
                    <span class="badge badge-success">Approved KYC</span>
                </td>
                <td style="font-weight: 700; color: {{ $buyer->ledgerEntries->sum('amount') > 0 ? 'var(--danger)' : 'var(--ink)' }};">
                    @php
                        $balance = 0;
                        foreach($buyer->ledgerEntries as $entry) {
                            if($entry->type == 'DEBIT') $balance += $entry->amount;
                            else $balance -= $entry->amount;
                        }
                    @endphp
                    ₹{{ number_format(max(0, $balance), 2) }} Due
                </td>
                <td>
                    <button class="btn btn-outline" style="padding: 4px 8px; font-size: 11px;">View Ledger</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 40px; color: var(--ink-soft);">
                    No buyers found in the system.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
