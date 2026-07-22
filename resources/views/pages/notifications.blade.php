@extends('layouts.storefront')

@section('content')
<style>
.page-header { background: var(--surface); padding: 40px 0; border-bottom: 1px solid var(--line); margin-bottom: 40px; }
.page-title { font-size: 28px; font-weight: 800; color: var(--ink); margin-bottom: 8px; }

.n-list { max-width: 800px; margin: 0 auto 80px; display: flex; flex-direction: column; gap: 16px; }
.n-item { background: white; border: 1px solid var(--line); border-left: 4px solid var(--gold); border-radius: 8px; padding: 20px; display: flex; gap: 16px; box-shadow: var(--shadow-sm); }
.n-item.read { border-left-color: var(--line-strong); opacity: 0.8; box-shadow: none; }
.n-icon { width: 40px; height: 40px; border-radius: 50%; background: var(--bg); display: flex; align-items: center; justify-content: center; color: var(--forest); flex-shrink: 0; }
.n-item.read .n-icon { color: var(--ink-soft); }

.n-content { flex: 1; }
.n-title { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
.n-desc { font-size: 13.5px; color: var(--ink-soft); line-height: 1.5; margin-bottom: 8px; }
.n-time { font-size: 12px; color: var(--ink-faint); font-weight: 500; }
</style>

<div class="page-header">
    <div class="container" style="max-width: 800px;">
        <h1 class="page-title">Market Alerts & Notifications</h1>
    </div>
</div>

<div class="container">
    <div class="n-list">
        @forelse($notifications as $n)
        <div class="n-item {{ $n->is_read ? 'read' : '' }}">
            <div class="n-icon">
                @if($n->type == 'info')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg>
                @endif
            </div>
            <div class="n-content">
                <div class="n-title">{{ $n->title }}</div>
                <div class="n-desc">{{ $n->message }}</div>
                <div class="n-time">{{ $n->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding:40px; color:var(--ink-soft);">You have no new notifications.</div>
        @endforelse
    </div>
</div>
@endsection
