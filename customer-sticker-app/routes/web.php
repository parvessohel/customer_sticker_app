<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::resource('customers', CustomerController::class);

Route::get('customers/{id}/print', [CustomerController::class, 'printSticker'])->name('customers.print');

