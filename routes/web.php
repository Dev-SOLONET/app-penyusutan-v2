<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Management\BiayaTetapController;
use App\Http\Controllers\Management\BiayaDimukaController;

// Route group management
Route::group(['prefix' => 'management', 'as' => 'management.'], function () {
    Route::resources([
        'biaya-tetap' => BiayaTetapController::class,
        'biaya-dimuka' => BiayaDimukaController::class,
    ]);
});

// Route group admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resources([
        'pengguna'  => PenggunaController::class,
        'satuan'    => SatuanController::class,
    ]);
});