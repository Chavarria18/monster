<?php

use App\Http\Controllers\CombatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonsterController;
Route::resource('monster', MonsterController::class);
Route::resource('combat', CombatController::class);
Route::get('/history', [CombatController::class, 'history'])
    ->name('history.index');
Route::get('/fight/{id1}/{id2}', [CombatController::class, 'fight']);