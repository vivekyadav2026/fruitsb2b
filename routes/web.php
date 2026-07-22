<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BuyerOrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PriceUpdateController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

// Public Buyer Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Static Pages
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/bulk-deals', [App\Http\Controllers\BulkDealController::class, 'index'])->name('bulk-deals');
Route::get('/ledger', [App\Http\Controllers\LedgerController::class, 'index'])->name('ledger');
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Admin ERP Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
    
    // Core Modules Implemented
    Route::get('/rates', [App\Http\Controllers\Admin\MandiRatesController::class, 'index'])->name('admin.rates');
    Route::post('/rates', [App\Http\Controllers\Admin\MandiRatesController::class, 'update'])->name('admin.rates.update');
    Route::get('/buyers', [App\Http\Controllers\Admin\BuyerController::class, 'index'])->name('admin.buyers');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
    Route::get('/ledger', [App\Http\Controllers\Admin\LedgerController::class, 'index'])->name('admin.ledger');
    Route::get('/inventory', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Inventory')->name('admin.inventory');
    
    // Shell Routes for secondary sidebar functionality
    Route::get('/categories', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Categories')->name('admin.categories');
    Route::get('/suppliers', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Suppliers')->name('admin.suppliers');
    Route::get('/purchase-orders', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Purchase Orders')->name('admin.po');
    Route::get('/sales', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Sales')->name('admin.sales');
    Route::get('/invoices', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Invoices')->name('admin.invoices');
    Route::get('/payments', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Payments')->name('admin.payments');
    Route::get('/dispatch', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Dispatch')->name('admin.dispatch');
    Route::get('/delivery', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Delivery')->name('admin.delivery');
    Route::get('/returns', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Returns')->name('admin.returns');
    Route::get('/reports', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Reports')->name('admin.reports');
    Route::get('/notifications', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Notifications')->name('admin.notifications');
    Route::get('/coupons', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Coupons')->name('admin.coupons');
    Route::get('/banners', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Banner Management')->name('admin.banners');
    Route::get('/reviews', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Reviews')->name('admin.reviews');
    Route::get('/support', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Support Tickets')->name('admin.support');
    Route::get('/employees', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Employees')->name('admin.employees');
    Route::get('/roles', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Roles & Permissions')->name('admin.roles');
    Route::get('/cms', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Website CMS')->name('admin.cms');
    Route::get('/settings', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Settings')->name('admin.settings');
    Route::get('/logs', [App\Http\Controllers\Admin\ShellController::class, 'view'])->defaults('page', 'Activity Logs')->name('admin.logs');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    Route::get('/my-orders', [BuyerOrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{id}', [BuyerOrderController::class, 'show'])->name('orders.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
