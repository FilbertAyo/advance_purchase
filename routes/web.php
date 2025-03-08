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
});

require __DIR__ . '/auth.php';

Route::resource('item', ItemController::class)->middleware(['auth', 'verified']);
Route::post('/items/{item}/upload-image', [ItemController::class, 'uploadImage'])->name('items.upload_image');
Route::delete('/items/image/{id}', [ItemController::class, 'deleteImage'])->name('items.delete_image');



Route::get('/user', [DashboardController::class, 'user'])->middleware(['auth', 'verified']);

Route::get('/unverified', [CustomerController::class, 'unverifiedCustomer'])->middleware(['auth', 'verified']);
Route::post('/register', [DashboardController::class, 'register']);
Route::post('/registration_form', [RegisteredUserController::class, 'store']);
Route::delete('/user/{id}', [DashboardController::class, 'destroy'])->name('user.destroy')->middleware(['auth', 'verified']);

Route::resource('customer', CustomerController::class)->middleware(['auth', 'verified']);
Route::resource('application', ApplicationController::class)->middleware(['auth', 'verified']);
Route::get('/pending_application', [ApplicationController::class, 'inactive'])->middleware(['auth', 'verified'])->name('application.inactive');
Route::post('/activate/{id}', [ApplicationController::class, 'activate'])
    ->middleware(['auth', 'verified'])
    ->name('application.activate');

Route::get('/details/{id}', [ApplicationController::class, 'view'])->name('application.details')->middleware(['auth', 'verified']);
Route::put('/details/{id}/edit', [ApplicationController::class, 'updateSerialNo'])->name('serialNo.update');
// Route::get('')

Route::post('/user/toggle-status/{id}', [ProfileController::class, 'toggleStatus'])->name('user.toggleStatus');
Route::get('/product', [ItemController::class, 'product'])->middleware(['auth', 'verified']);

Route::resource('address', AddressController::class);
Route::get('/regions', [AddressController::class, 'regions'])->middleware(['auth', 'verified']);
Route::post('/region_store', [AddressController::class, 'regionStore']);
Route::delete('/region/{id}', [AddressController::class, 'regionDestroy'])->name('region.destroy')->middleware(['auth', 'verified']);
Route::get('/wards', [AddressController::class, 'wards'])->middleware(['auth', 'verified']);
Route::post('/ward_store', [AddressController::class, 'wardStore']);
Route::delete('/ward/{id}', [AddressController::class, 'wardDestroy'])->name('ward.destroy')->middleware(['auth', 'verified']);

Route::get('/bank', [DashboardController::class, 'bank'])->middleware(['auth', 'verified']);
Route::post('bank_store', [DashboardController::class, 'bank_store'])->middleware(['auth', 'verified']);
Route::patch('/bank/{id}/disable', [DashboardController::class, 'disable'])->name('bank.disable');

Route::resource('branch',BranchController::class);

Route::get('locale/{lang}',[LocaleController::class, 'setLocale']);

Route::get('/deliveries',[DeliveryController::class,'allDelivery'])->middleware(['auth', 'verified']);
Route::put('/delivery_update/{id}', [DeliveryController::class, 'deliveryUpdate'])->name('delivery.update')->middleware(['auth', 'verified']);
Route::get('delivered',[DeliveryController::class,'delivered'])->middleware(['auth', 'verified']);
Route::get('/pending_delivery',[DeliveryController::class,'deliveryPending'])->middleware(['auth', 'verified']);
Route::get('/products/search', [ItemController::class, 'product'])->name('products.search');

Route::post('/relative/store', [ProfileController::class, 'storeRelative'])->name('relative.store');
Route::delete('/relative/{id}', [ProfileController::class, 'destroyRelative'])->name('relative.destroy');
Route::post('/profile_picture/update', [ProfileController::class, 'updateProfile'])->name('prof.update');

Route::get('report/statements',[ReportController::class,'statements'])->name('report.statements')->middleware(['auth', 'verified']);
Route::get('report/outstanding',[ReportController::class,'outstanding'])->name('report.outstanding')->middleware(['auth', 'verified']);
Route::get('report/paid',[ReportController::class,'paid'])->name('report.paid')->middleware(['auth', 'verified']);
Route::get('report/invoice/{id}', [ReportController::class, 'invoice'])->name('invoice')->middleware(['auth', 'verified']);

// Route::get('/export-excel', [ReportController::class, 'exportExcel'])->name('export.excel');

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

Route::get('/sendSms',[SmsController::class,'sendSms']);

Route::post('/screenshot/store', [ApplicationController::class, 'screenshot'])->name('screenshot.store');
Route::delete('/screenshot/{id}', [ApplicationController::class, 'screenshotDestroy'])->name('screenshot.destroy');
