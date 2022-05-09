<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MatchesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StadiumsController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TvchannelsController;
use App\Http\Controllers\FootballController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('football')->group(function(){

    Route::prefix('v1')->group(function(){
        Route::apiResource('/', FootballController::class);
        Route::apiResource('/stadiums', StadiumsController::class);
        Route::apiResource('/tvchannels', TvchannelsController::class);
        Route::apiResource('/teams', TeamsController::class);
        Route::apiResource('/groups', GroupsController::class);
        Route::apiResource('/matches', MatchesController::class);
        Route::get('/documentation', function(){
            return view('apiDocumentation');
        });
    });
    
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
