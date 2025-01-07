<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\ExcelImportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/import',[ExcelImportController::class,'import'])->name('import');
Route::get('/failed-imports/download', [ExcelImportController::class, 'generateFailedRowsExcel'])->name('download_failed');

Route::controller(ProductController::class)
->prefix('product')
->as('product.')
->group(function(){
    Route::get('{id}/single-page',[ProductController::class,"productsinglepage"])->name('singlepage');
    Route::post('ratting','ProductRattingPage')->name("rattingpage");

});


Route::resource('products', ProductController::class);

Route::post('brandstatuschange',[BrandController::class,"brandstatuschange"])->name("brandstatuschange");
Route::resource('brand',BrandController::class);