<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daily Price Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                
                @if(session('success'))
                    <div class="p-4 bg-green-100 text-green-700 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.prices.update') }}" method="POST">
                    @csrf
                    
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Update Today's Prices</h3>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                                Save All Changes
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (₹)</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($products as $product)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $product->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->category === 'Fruits' ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ $product->category }}
                                                </span>
                                            </td>
@extends('layouts.admin')

@push('styles')
<style>
  .stats{ display:flex; gap:14px; }
  .stat{ background:#1B2A20; border:1px solid var(--line); border-radius:8px; padding:10px 16px; min-width:110px; }
  .stat .n{ font-family:'IBM Plex Mono'; font-size:20px; font-weight:700; }
  .stat .l{ font-size:11px; color:var(--ink-soft); margin-top:2px; }

  .grid-table{ width:100%; border-collapse:collapse; background:#1B2A20; border:1px solid var(--line); border-radius:10px; overflow:hidden; }
  .grid-table thead th{
    text-align:left; font-size:11px; letter-spacing:0.8px; color:var(--ink-soft); font-weight:600;
    padding:12px 14px; border-bottom:1px solid var(--line); text-transform:uppercase;
  }
  .grid-table tbody td{ padding:10px 14px; border-bottom:1px solid var(--line); font-size:13.5px; vertical-align:middle; }
  .grid-table tbody tr:last-child td{ border-bottom:none; }
  .grid-table tbody tr:hover{ background:rgba(255,255,255,0.02); }

  .p-name{ display:flex; align-items:center; gap:10px; }
  .p-thumb{ width:34px;height:34px; border-radius:6px; background:#2A3D28; display:flex;align-items:center;justify-content:center; font-size:17px; }
  .p-name .txt b{ display:block; font-size:13.5px; }
  .p-name .txt span{ font-size:11.5px; color:var(--ink-soft); }

  .price-input-wrap{ display:flex; align-items:center; gap:6px; }
  .price-input-wrap .cur{ color:var(--ink-soft); font-size:13px; }
  .price-input-wrap input{
    width:88px; background:#141F18; border:1.5px solid var(--line); border-radius:6px;
    padding:7px 8px; color:var(--paper); font-family:'IBM Plex Mono'; font-size:13.5px; font-weight:600;
  }
  .price-input-wrap input.changed{ border-color:var(--turmeric); background:rgba(217,164,65,0.08); }
  .unit-lbl{ font-size:11.5px; color:var(--ink-soft); }

  select.stock-select {
      background:#141F18; border:1.5px solid var(--line); border-radius:6px;
      padding:7px 8px; color:var(--paper); font-size:13.5px; font-weight:600;
  }
</style>
@endpush

@section('content')

<form action="{{ route('admin.prices.update') }}" method="POST">
    @csrf

    <div class="topline">
      <div>
        <div class="eyebrow">Aaj Ka Bhaav &middot; {{ date('d M Y') }}</div>
        <h1>Update Today's Rates</h1>
        <div class="sub">Edit prices below and save once — every buyer sees the new rate instantly.</div>
      </div>
      <div class="stats">
        <div class="stat"><div class="n">{{ $products->count() }}</div><div class="l">PRODUCTS</div></div>
      </div>
    </div>
    
    @if(session('success'))
        <div style="background:var(--fresh); color:#fff; padding:12px 16px; border-radius:8px; margin:20px 0; font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    <table class="grid-table" style="margin-top:20px;">
      <thead>
        <tr>
          <th>Product</th>
          <th>Today's Price</th>
          <th>Stock Status</th>
          <th>Last Updated</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>
              <div class="p-name">
                  <div class="p-thumb">
                    @php
                        $emoji = '🍎';
                        $n = strtolower($product->name);
                        if(str_contains($n, 'onion')) $emoji = '🧅';
                        elseif(str_contains($n, 'tomato')) $emoji = '🍅';
                        elseif(str_contains($n, 'banana')) $emoji = '🍌';
                        elseif(str_contains($n, 'potato')) $emoji = '🥔';
                        elseif(str_contains($n, 'orange')) $emoji = '🍊';
                        elseif(str_contains($n, 'cabbage')) $emoji = '🥬';
                        elseif(str_contains($n, 'chilli')) $emoji = '🌶️';
                    @endphp
                    {{ $emoji }}
                  </div>
                  <div class="txt">
                      <b>{{ $product->name }}</b>
                      <span>{{ $product->category }}</span>
                  </div>
              </div>
          </td>
          <td>
              <div class="price-input-wrap">
                  <span class="cur">₹</span>
                  <input type="number" step="any" name="products[{{ $product->id }}][price]" value="{{ $product->price }}">
                  <span class="unit-lbl">/{{ $product->unit }}</span>
              </div>
          </td>
          <td>
              <select class="stock-select" name="products[{{ $product->id }}][stock_status]">
                  <option value="IN_STOCK" {{ $product->stock_status == 'IN_STOCK' ? 'selected' : '' }}>In Stock</option>
                  <option value="LIMITED" {{ $product->stock_status == 'LIMITED' ? 'selected' : '' }}>Limited</option>
                  <option value="OUT_OF_STOCK" {{ $product->stock_status == 'OUT_OF_STOCK' ? 'selected' : '' }}>Out of Stock</option>
              </select>
          </td>
          <td style="font-size:11.5px; color:var(--ink-soft);">
              {{ $product->updated_at->diffForHumans() }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="savebar">
      <div class="left">Update rates directly and save.</div>
      <div class="actions">
        <button type="submit" class="btn-save">Save All Prices</button>
      </div>
    </div>

</form>

@endsection
