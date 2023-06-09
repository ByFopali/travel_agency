<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\TourUserController;
use App\Http\Controllers\Api\UserController;
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

Route::apiResources([
    'countries' => CountryController::class,
    'places' => PlaceController::class,
    'discounts' => DiscountController::class,
    'users' => UserController::class,
    'tours' => TourController::class,
    'tour_users' => TourUserController::class
]);
