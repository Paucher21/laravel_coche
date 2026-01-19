<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

Route::get('/sales', [SaleController::class, 'index']);
Route::post('/sales', [SaleController::class, 'store']);
Route::patch('/sales/{id}', [SaleController::class, 'updateStatus']);