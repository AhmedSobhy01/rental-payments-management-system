<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/translations', [ApiController::class, 'translations'])->name('api.translations');

Route::post('/tenants', [ApiController::class, 'tenants'])->name('api.tenants');

Route::post('/tenant', [ApiController::class, 'tenant'])->name('api.tenant');