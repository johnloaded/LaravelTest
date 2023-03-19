<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('vendors', VendorController::class);

Route::namespace('App\Http\Controllers')->group(function() {
    Route::get('vendors/{macaddress}', 'VendorController@macaddress');
    Route::post('vendors/multiple-mac', 'VendorController@multipleMac');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
