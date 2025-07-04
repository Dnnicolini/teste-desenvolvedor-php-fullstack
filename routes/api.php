<?php

use Illuminate\Support\Facades\Route;


Route::prefix('suppliers')->controller(App\Http\Controllers\SupplierController::class)->group(function () {
    Route::get('/', 'index')->name('suppliers.index');
    Route::post('/store', 'store')->name('suppliers.store');
    Route::get('/show/{supplier}', 'show')->name('suppliers.show');
    Route::put('/update/{supplier}', 'update')->name('suppliers.update');
    Route::delete('/delete/{supplier}', 'destroy')->name('suppliers.destroy');
});