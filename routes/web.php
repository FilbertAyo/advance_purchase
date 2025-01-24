<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdvanceFormController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\AdvanceForm;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'home'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('item', ItemController::class)->middleware(['auth', 'verified']);

Route::get('/user',[DashboardController::class, 'user'])->middleware(['auth', 'verified']);

Route::get('/unverified',[CustomerController::class, 'unverifiedCustomer'])->middleware(['auth', 'verified']);
Route::post('/register',[DashboardController::class, 'register']);
Route::post('/registration_form',[RegisteredUserController::class, 'store']);
Route::delete('/user/{id}', [DashboardController::class, 'destroy'])->name('user.destroy')->middleware(['auth', 'verified']);

Route::resource('customer',CustomerController::class)->middleware(['auth', 'verified']);
Route::resource('application',ApplicationController::class)->middleware(['auth', 'verified']);
Route::get('/pending_application',[ApplicationController::class, 'inactive'])->middleware(['auth', 'verified'])->name('application.inactive');
Route::post('/activate/{id}', [ApplicationController::class, 'activate'])
    ->middleware(['auth', 'verified'])
    ->name('application.activate');

Route::get('/details/{id}', [ApplicationController::class, 'view'])->name('application.details')->middleware(['auth', 'verified']);

//enable and disable user
Route::post('/user/toggle-status/{id}', [ProfileController::class, 'toggleStatus'])->name('user.toggleStatus');
// Route::resource('products',ProductController::class)->middleware(['auth', 'verified']);
Route::get('/product',[ItemController::class, 'product'])->middleware(['auth', 'verified']);

Route::resource('address', AddressController::class);
Route::get('/regions',[AddressController::class, 'regions'])->middleware(['auth', 'verified']);
Route::post('/region_store',[AddressController::class, 'regionStore']);
Route::delete('/region/{id}', [AddressController::class, 'regionDestroy'])->name('region.destroy')->middleware(['auth', 'verified']);
Route::get('/wards',[AddressController::class, 'wards'])->middleware(['auth', 'verified']);
Route::post('/ward_store',[AddressController::class, 'wardStore']);
Route::delete('/ward/{id}', [AddressController::class, 'wardDestroy'])->name('ward.destroy')->middleware(['auth', 'verified']);

Route::get('/bank',[DashboardController::class, 'bank'])->middleware(['auth', 'verified']);
Route::post('bank_store',[DashboardController::class, 'bank_store'])->middleware(['auth', 'verified']);
Route::patch('/bank/{id}/disable', [DashboardController::class, 'disable'])->name('bank.disable');



// maintenance
Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');
