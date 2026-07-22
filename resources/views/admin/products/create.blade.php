@extends('layouts.admin')

@section('content')
<div class="page-header-wrap">
    <div class="breadcrumb">
        <a href="{{ route('admin.products') }}" style="text-decoration:none; color:inherit;">Products</a> &nbsp;/&nbsp; Add New Commodity
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 class="page-title">Add New Commodity</h1>
    </div>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="field">
                <label>Commodity Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Onion Nashik A">
                @error('name')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Category *</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Price (₹) *</label>
                <input type="number" step="0.01" name="price_per_unit" value="{{ old('price_per_unit') }}" required placeholder="e.g. 45.50">
                @error('price_per_unit')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Unit of Measurement *</label>
                <select name="unit" required>
                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                    <option value="ton" {{ old('unit') == 'ton' ? 'selected' : '' }}>Tons</option>
                    <option value="crate" {{ old('unit') == 'crate' ? 'selected' : '' }}>Crate</option>
                    <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                    <option value="dozen" {{ old('unit') == 'dozen' ? 'selected' : '' }}>Dozen</option>
                </select>
                @error('unit')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Minimum Order Quantity *</label>
                <input type="number" name="min_order_qty" value="{{ old('min_order_qty', 50) }}" required>
                @error('min_order_qty')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Quality Grade *</label>
                <select name="grade" required>
                    <option value="A+" {{ old('grade') == 'A+' ? 'selected' : '' }}>Grade A+ (Export Quality)</option>
                    <option value="A" {{ old('grade') == 'A' ? 'selected' : '' }}>Grade A</option>
                    <option value="B" {{ old('grade') == 'B' ? 'selected' : '' }}>Grade B</option>
                    <option value="C" {{ old('grade') == 'C' ? 'selected' : '' }}>Grade C</option>
                </select>
                @error('grade')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Origin / Region *</label>
                <input type="text" name="origin" value="{{ old('origin') }}" required placeholder="e.g. Nashik, Maharashtra">
                @error('origin')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            
            <div class="field">
                <label>Stock Status *</label>
                <select name="stock_status" required>
                    <option value="IN_STOCK" {{ old('stock_status') == 'IN_STOCK' ? 'selected' : '' }}>In Stock</option>
                    <option value="LIMITED" {{ old('stock_status') == 'LIMITED' ? 'selected' : '' }}>Limited Stock</option>
                    <option value="SOLD_OUT" {{ old('stock_status') == 'SOLD_OUT' ? 'selected' : '' }}>Sold Out</option>
                </select>
                @error('stock_status')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="field">
            <label>Description</label>
            <textarea name="description" rows="3" style="width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--line-strong); font-family:inherit; font-size:14.5px;">{{ old('description') }}</textarea>
            @error('description')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
        </div>
        
        <div style="display:flex; gap:20px; margin-top:16px; margin-bottom:24px; padding:16px; background:var(--bg); border-radius:8px;">
            <label style="display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_gst_available" value="1" {{ old('is_gst_available', 1) ? 'checked' : '' }}>
                GST Invoice Available
            </label>
            <label style="display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_delivery_available" value="1" {{ old('is_delivery_available', 1) ? 'checked' : '' }}>
                Delivery Available
            </label>
            <label style="display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_pickup_available" value="1" {{ old('is_pickup_available', 1) ? 'checked' : '' }}>
                Pickup Available
            </label>
        </div>
        
        <div style="display:flex; gap:12px;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 32px;">Save Commodity</button>
            <a href="{{ route('admin.products') }}" class="btn btn-outline" style="padding: 12px 32px;">Cancel</a>
        </div>
    </form>
</div>
@endsection
