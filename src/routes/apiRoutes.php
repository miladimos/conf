<?php


use Illuminate\Support\Facades\Route;
use Miladimos\Conf\Http\Controllers\ConfigJsonController;

Route::get('all', [ConfigJsonController::class, 'all'])->name('conf.all');
Route::get('show/{id}', [ConfigJsonController::class, 'show'])->name('conf.show');
Route::post('update/{id}', [ConfigJsonController::class, 'update'])->name('conf.update');
Route::post('store', [ConfigJsonController::class, 'store'])->name('conf.store');
Route::get('delete/{id}', [ConfigJsonController::class, 'delete'])->name('conf.delete');
