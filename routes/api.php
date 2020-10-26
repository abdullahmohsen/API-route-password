<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;


//All API here mush be api authenticated
Route::group(['middleware' => ['api', 'checkPassword', 'changeLanguage'], 'namespace' => 'Api'], function(){

    Route::post('get-categories', [CategoriesController::class, 'index']);
    Route::post('get-category-byId', [CategoriesController::class, 'getCategoryById']);
    Route::post('change-category-status', [CategoriesController::class, 'changeStatus']);

    Route::group(['prefix' => 'admin'], function() {
        Route::post('login', [Admin\AuthController::class, 'login']);

    });
});


Route::group(['middleware' => 'api', 'checkPassword', 'changeLanguage', 'checkAdminToken:admin-api'], function() {

    Route::get('offers', [Api\CategoriesController::class, 'index']);

});

