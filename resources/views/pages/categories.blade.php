@extends('layouts.storefront')

@section('content')
<style>
.page-header { background: var(--surface); padding: 60px 0; border-bottom: 1px solid var(--line); margin-bottom: 40px; }
.page-title { font-size: 32px; font-weight: 800; color: var(--ink); margin-bottom: 12px; }
.page-desc { font-size: 15px; color: var(--ink-soft); max-width: 600px; line-height: 1.6; }

.cat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-bottom: 80px; }
.cat-card { background: white; border: 1px solid var(--line); border-radius: 12px; overflow: hidden; transition: 0.2s; display: flex; flex-direction: column; text-decoration: none; color: inherit; }
.cat-card:hover { border-color: var(--forest); box-shadow: var(--shadow-md); transform: translateY(-4px); }
.cat-img { height: 160px; background: var(--forest-soft); display: flex; align-items: center; justify-content: center; color: var(--forest); }
.cat-body { padding: 24px; flex: 1; }
.cat-title { font-size: 20px; font-weight: 700; margin-bottom: 8px; color: var(--ink); }
.cat-stats { font-size: 13px; color: var(--ink-soft); margin-bottom: 16px; font-weight: 600; }
.cat-desc { font-size: 13px; color: var(--ink-soft); line-height: 1.5; margin-bottom: 24px; }
.cat-link { font-size: 14px; font-weight: 600; color: var(--forest); display: flex; align-items: center; gap: 8px; margin-top: auto; }

@media (max-width: 768px) {
    .page-header { padding: 36px 0; margin-bottom: 24px; text-align: left; }
    .page-title { font-size: 24px; margin-bottom: 8px; }
    .page-desc { font-size: 13.5px; }
    .cat-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 12px !important; margin-bottom: 40px; }
    .cat-card { border-radius: 12px; }
    .cat-img { height: 110px; }
    .cat-img svg { width: 36px; height: 36px; }
    .cat-body { padding: 12px; }
    .cat-title { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
    .cat-stats { font-size: 11px; margin-bottom: 6px; }
    .cat-desc { display: none; }
    .cat-link { font-size: 11.5px; }
}
</style>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Wholesale Categories</h1>
        <p class="page-desc">Browse our extensive catalog of fresh produce. All commodities are sorted, graded, and ready for bulk dispatch from our central mandi warehouse.</p>
    </div>
</div>

<div class="container">
    <div class="cat-grid">
        @foreach($categories as $cat)
        <a href="{{ route('home') }}" class="cat-card">
            <div class="cat-img">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
            </div>
            <div class="cat-body">
                <div class="cat-title">{{ $cat->name }}</div>
                <div class="cat-stats">{{ $cat->products_count }} Commodities Available</div>
                <div class="cat-desc">{{ $cat->description }}</div>
                <div class="cat-link">View Live Rates &rarr;</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
