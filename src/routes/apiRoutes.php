<?php


use Illuminate\Support\Facades\Route;
use Miladimos\Conf\Http\Controller\ConfigJsonController;

Route::get('all', [ConfigJsonController::class, 'all']);
Route::get('show/{id}', [ConfigJsonController::class, 'show']);
Route::post('update/{id}', [ConfigJsonController::class, 'update']);
