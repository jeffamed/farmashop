<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BonusProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function (){
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('laboratories', LaboratoryController::class);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('presentations', PresentationController::class);
    Route::apiResource('reimbursements', ReimbursementController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('bonus-products', BonusProductController::class);
    Route::apiResource('products', ProductController::class);
    Route::get('reports', ReportController::class)->name('reports');
    Route::apiResource('suppliers', \App\Http\Controllers\SupplierController::class);
    Route::apiResource('sales', \App\Http\Controllers\SaleController::class);
    Route::apiResource('types', \App\Http\Controllers\TypeController::class);
    Route::apiResource('usages', \App\Http\Controllers\UsageController::class);
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::post('close-cash', \App\Http\Controllers\CloseCashController::class)->name('close-cash');
});
