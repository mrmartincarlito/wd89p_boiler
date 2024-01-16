<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * <form action="api/items/" method="POST">
 * </form>
 */

Route::apiResource('/user', UsersController::class);
Route::apiResource('/items', ItemsController::class);

Route::post('/checkout', [ItemsController::class, 'checkoutCounter']);
Route::post('/track-order', [ItemsController::class, 'trackOrder']);