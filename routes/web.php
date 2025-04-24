<?php

use App\Http\Controllers\CustomAjaxFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('store', [CustomAjaxFormController::class, 'store'])->name('store');
