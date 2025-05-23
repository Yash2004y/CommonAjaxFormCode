<?php

use App\Http\Controllers\CustomAjaxFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get("/list", [CustomAjaxFormController::class, 'list'])->name('list');
Route::get("/listwithpagination", [CustomAjaxFormController::class, 'list2'])->name('listwithpagination');
Route::post("/modalOpen", [CustomAjaxFormController::class, 'modalOpen'])->name('modalOpen');
Route::post('store', [CustomAjaxFormController::class, 'store'])->name('store');
Route::post('user-store/{id?}', [CustomAjaxFormController::class, 'UserStore'])->name('Userstore');
Route::post('deleteUser', [CustomAjaxFormController::class, 'deleteUser'])->name('deleteUser');
