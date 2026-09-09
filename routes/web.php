<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonsterController;
Route::resource('monster', MonsterController::class);