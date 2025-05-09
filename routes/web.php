<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdvanceFormController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [DashboardController::class, 'welcome']);

Route::get('/dashboard', [DashboardController::class, 'home'])
    ->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile-settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/toggle-activation/{id}', [ProfileController::class, 'toggleStatus'])->name('user.toggleStatus');
    Route::post('/relative/store', [ProfileController::class, 'storeRelative'])->name('relative.store');
    Route::delete('/relative/{id}', [ProfileController::class, 'destroyRelative'])->name('relative.destroy');
    Route::post('/profile_picture/update', [ProfileController::class, 'updateProfile'])->name('prof.update');

    Route::get('/my-dashboard', [DashboardController::class, 'myDashboard'])->name('my.dashboard');
    Route::get('/analytics/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user', [DashboardController::class, 'user']);
    Route::get('/bank', [DashboardController::class, 'bank']);
    Route::post('bank_store', [DashboardController::class, 'bank_store']);
    Route::patch('/bank/{id}/disable', [DashboardController::class, 'disable'])->name('bank.disable');
    Route::delete('/user/{id}', [DashboardController::class, 'destroy'])->name('user.destroy');
    Route::post('/register', [DashboardController::class, 'register']);

    Route::get('/products/list', [ItemController::class, 'product'])->name('products.list');
    Route::get('/product_view/{id}', [ItemController::class, 'product_view']);
    Route::resource('item', ItemController::class);
    Route::post('/items/{item}/upload-image', [ItemController::class, 'uploadImage'])->name('items.upload_image');
    Route::delete('/items/image/{id}', [ItemController::class, 'deleteImage'])->name('items.delete_image');
    Route::get('/products/search', [ItemController::class, 'product'])->name('products.search');

    Route::get('/customers/list', [CustomerController::class, 'index'])->name('customers.list');
    Route::resource('customer', CustomerController::class);
    Route::get('customers/unverified/list', [CustomerController::class, 'unverifiedCustomer'])->name('unverified.customer');

    Route::resource('application', ApplicationController::class);
    Route::get('/applications/active/list', [ApplicationController::class, 'index'])->name('application.list');
    Route::get('/pending_application', [ApplicationController::class, 'inactive'])->name('application.inactive');
    Route::post('/activate/{id}', [ApplicationController::class, 'activate'])->name('application.activate');
    Route::get('/details/{id}', [ApplicationController::class, 'view'])->name('application.details');
    Route::put('/details/{id}/edit', [ApplicationController::class, 'updateSerialNo'])->name('serialNo.update');
    Route::delete('/advances/{id}', [ApplicationController::class, 'advanceDestroy'])->name('advances.destroy');
    Route::put('/application/{id}/refund', [ApplicationController::class, 'refundRequest'])->name('refund.request');
    Route::put('/application/{id}/refund-cancel', [ApplicationController::class, 'refundCancel'])->name('refund.cancel');
    Route::put('/application/{id}/refund-approve', [ApplicationController::class, 'refundApprove'])->name('refund.approve');
    Route::post('/screenshot/store', [ApplicationController::class, 'screenshot'])->name('screenshot.store');
    Route::delete('/screenshot/{id}', [ApplicationController::class, 'screenshotDestroy'])->name('screenshot.destroy');

    Route::get('/delivery/{filter?}', [DeliveryController::class, 'delivery'])->name('delivery.filter');
    Route::put('/delivery_update/{id}', [DeliveryController::class, 'deliveryUpdate'])->name('delivery.update');

    Route::get('report/statements', [ReportController::class, 'statements'])->name('report.statements');
    Route::get('report/outstanding', [ReportController::class, 'outstanding'])->name('report.outstanding');
    Route::get('report/paid', [ReportController::class, 'paid'])->name('report.paid');
    Route::get('report/invoice/{id}', [ReportController::class, 'invoice'])->name('invoice');
    Route::get('report/refunds', [ReportController::class, 'refunds'])->name('report.refunds');

    Route::resource('address', AddressController::class);
    Route::get('/regions', [AddressController::class, 'regions']);
    Route::post('/region_store', [AddressController::class, 'regionStore']);
    Route::delete('/region/{id}', [AddressController::class, 'regionDestroy'])->name('region.destroy');
    Route::get('/wards', [AddressController::class, 'wards']);
    Route::post('/ward_store', [AddressController::class, 'wardStore']);
    Route::delete('/ward/{id}', [AddressController::class, 'wardDestroy'])->name('ward.destroy');
});

require __DIR__ . '/auth.php';

Route::post('/registration_form', [RegisteredUserController::class, 'store']);

Route::get('/get-districts/{city_id}', [AddressController::class, 'getDistricts']);
Route::get('/get-wards/{district_id}', [AddressController::class, 'getWards']);;


Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);


Route::post('/update-reminder-status', function () {
    session()->put('remind_later', true);
});
// maintenance
Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');

Route::get('/test', function () {
    return view('profile.edit');
});

Route::get('/sendSms', [SmsController::class, 'sendSms']);
