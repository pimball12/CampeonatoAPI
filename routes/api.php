<?php

use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\MatchupController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function()  {

    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function() {

    Route::apiResource('championships', ChampionshipController::class);
    Route::apiResource('matchups', MatchupController::class);
    Route::apiResource('teams', TeamController::class);
});
