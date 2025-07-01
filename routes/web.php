<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'welcome']);
Route::get('/get-districts/{city_id}', [AddressController::class, 'getDistricts']);
Route::get('/get-wards/{district_id}', [AddressController::class, 'getWards']);;
Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);
Route::post('/update-reminder-status', function () {
    session()->put('remind_later', true);
});
Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');
Route::get('/catalogue', [ItemController::class, 'catalogue']);
Route::get('/sendSms', [SmsController::class, 'sendSms']);
Route::post('/registration/new/customer', [RegisteredUserController::class, 'store'])->name('registration.store');


Route::get('/dashboard', [DashboardController::class, 'home'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile-settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/relative/store', [ProfileController::class, 'storeRelative'])->name('relative.store');
    Route::delete('/relative/{id}', [ProfileController::class, 'destroyRelative'])->name('relative.destroy');
    Route::post('/profile_picture/update', [ProfileController::class, 'updateProfile'])->name('prof.update');

    Route::get('/my/advance/dashboard', [DashboardController::class, 'myDashboard'])->name('my.dashboard');
    Route::get('/products/list', [ItemController::class, 'product'])->name('products.list');
    Route::get('/product/view/{id}', [ItemController::class, 'product_view'])->name('product.view');
    Route::get('/details/{id}', [ApplicationController::class, 'view'])->name('application.details');
    Route::post('/screenshot/store', [ApplicationController::class, 'screenshot'])->name('screenshot.store');
    Route::delete('/screenshot/{id}', [ApplicationController::class, 'screenshotDestroy'])->name('screenshot.destroy');
    Route::get('/products/search', [ItemController::class, 'product'])->name('products.search');
    Route::put('/application/{id}/refund', [ApplicationController::class, 'refundRequest'])->name('refund.request');
    Route::put('/application/{id}/refund-cancel', [ApplicationController::class, 'refundCancel'])->name('refund.cancel');
});

Route::middleware(['permission:manage applications'])->group(function () {
    Route::post('application/store', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::put('application/{application}', [ApplicationController::class, 'update'])->name('application.update');
    Route::patch('application/{application}', [ApplicationController::class, 'update']);
    Route::delete('application/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');
});

Route::middleware(['permission:view applications'])->group(function () {
    Route::get('application', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('application/{application}', [ApplicationController::class, 'show'])->name('application.show');
    Route::get('application/{application}/edit', [ApplicationController::class, 'edit'])->name('application.edit');
});

Route::middleware(['permission:refund management approval'])->group(function () {
    Route::put('/application/{id}/refund-approve', [ApplicationController::class, 'refundApprove'])->name('refund.approve');
});

// ADMIN ROUTES
Route::middleware(['permission:view dashboard'])->group(function () {
    Route::get('/analytics/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['permission:view customers'])->group(function () {
    Route::get('/customers/list', [CustomerController::class, 'index'])->name('customers.list');
    Route::resource('customer', CustomerController::class);
    Route::get('customers/unverified/list', [CustomerController::class, 'unverifiedCustomer'])->name('unverified.customer');
});

Route::middleware(['permission:view applications'])->group(function () {
    Route::get('/applications/active/list', [ApplicationController::class, 'index'])->name('application.list');
    Route::get('/pending/application', [ApplicationController::class, 'inactive'])->name('application.inactive');
    Route::post('/activate/{id}', [ApplicationController::class, 'activate'])->name('application.activate');
    Route::put('/details/{id}/edit', [ApplicationController::class, 'updateSerialNo'])->name('serialNo.update');
    Route::delete('/advances/{id}', [ApplicationController::class, 'advanceDestroy'])->name('advances.destroy');
});
Route::middleware(['permission:view users'])->group(function () {
    Route::get('/users/admin/list', [DashboardController::class, 'user'])->name('users.index');
});

Route::middleware(['permission:manage users'])->group(function () {
    Route::post('/register/new/admin', [DashboardController::class, 'register'])->name('users.register');
    Route::post('/user/toggle-activation/{id}', [ProfileController::class, 'toggleStatus'])->name('user.toggleStatus');
    Route::put('/roles/{id}', [DashboardController::class, 'update'])->name('roles.update');
});
Route::middleware(['permission:manage settings'])->group(function () {
    Route::resource('address', AddressController::class);
    Route::get('/regions', [AddressController::class, 'regions'])->name('regions.index');
    Route::post('/region_store', [AddressController::class, 'regionStore'])->name('regions.store');
    Route::delete('/region/{id}', [AddressController::class, 'regionDestroy'])->name('region.destroy');
    Route::get('/wards', [AddressController::class, 'wards'])->name('wards.index');
    Route::post('/ward_store', [AddressController::class, 'wardStore'])->name('wards.store');
    Route::delete('/ward/{id}', [AddressController::class, 'wardDestroy'])->name('ward.destroy');
});

Route::middleware(['permission:update bank account'])->group(function () {
    Route::get('/bank/payment/accounts', [DashboardController::class, 'bank'])->name('bank.index');
    Route::post('bank/store', [DashboardController::class, 'bank_store'])->name('bank.store');
    Route::patch('/bank/{id}/disable', [DashboardController::class, 'disable'])->name('bank.disable');
});

Route::get('items/list/all', [ItemController::class, 'index'])
    ->middleware('permission:view items')
    ->name('items.index');
Route::post('items/manage', [ItemController::class, 'store'])
    ->middleware('permission:add items')
    ->name('items.store');

Route::middleware(['permission:edit items'])->group(function () {
    Route::get('items/manage/edit/{item}', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('items/manage/update/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::get('items/manage/show/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::post('/items/{item}/upload-image', [ItemController::class, 'uploadImage'])->name('items.upload_image');
    Route::delete('/items/image/{id}', [ItemController::class, 'deleteImage'])->name('items.delete_image');
});

Route::delete('items/manage/delete/{item}', [ItemController::class, 'destroy'])
    ->middleware('permission:delete items')
    ->name('items.destroy');

Route::middleware(['permission:view reports'])->group(function () {
    Route::get('report/statements', [ReportController::class, 'statements'])->name('report.statements');
    Route::get('report/outstanding', [ReportController::class, 'outstanding'])->name('report.outstanding');
    Route::get('report/paid', [ReportController::class, 'paid'])->name('report.paid');
    Route::get('report/invoice/{id}', [ReportController::class, 'invoice'])->name('invoice');
    Route::get('report/refunds', [ReportController::class, 'refunds'])->name('report.refunds');
});

Route::middleware(['permission:confirm delivery'])->group(function () {
    Route::get('/delivery/{filter?}', [DeliveryController::class, 'delivery'])->name('delivery.filter');
    Route::put('/delivery_update/{id}', [DeliveryController::class, 'deliveryUpdate'])->name('delivery.update');
});



require __DIR__ . '/auth.php';
