<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* La forma de crear Apis para hacer el consumo de Vue, React, Next, etc */
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
