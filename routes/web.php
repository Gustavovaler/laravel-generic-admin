<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
   return "hola";
});
//Route::resource('/admin', AdminController::class);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/{id}', [AdminController::class, 'show']);
Route::get('/admin/{id}/create', [AdminController::class, 'create']);
Route::post('/admin/store/{table}', [AdminController::class, 'store']);
Route::post('/admin/{model}/{id}', [AdminController::class, 'destroy']);
