<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Routing\Route;

Route::get('/items', [ItemController::class, 'index'])->middleware('auth:sanctum');
