@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 class="page-title" style="margin: 0; margin-bottom: 8px;">{{ $page }}</h1>
        <div style="font-size: 13px; color: var(--ink-soft);">
            Manage your {{ strtolower($page) }} and configure related settings.
        </div>
    </div>
    
    <div style="display: flex; gap: 12px;">
        <button class="btn btn-outline">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Export
        </button>
        <button class="btn btn-primary">
            + Create New
        </button>
    </div>
</div>

<div class="card" style="padding: 60px 20px; text-align: center; border: 1px dashed var(--line-strong);">
    <div style="width: 64px; height: 64px; background: var(--bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; color: var(--ink-faint);">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
    </div>
    <h3 style="font-size: 18px; margin-bottom: 8px;">{{ $page }} Module</h3>
    <p style="color: var(--ink-soft); font-size: 14px; max-width: 400px; margin: 0 auto;">
        This module is currently in development. Full CRUD operations and data tables will be deployed here soon.
    </p>
</div>
@endsection
