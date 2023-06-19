<?php

use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\Gallery\AlbumController;
use App\Http\Controllers\Api\Gallery\AlbumPictureController;
use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\Api\Kanban\ProjectController;
use App\Http\Controllers\Api\Kanban\StatusController;
use App\Http\Controllers\Api\SystemConfigController;
use App\Http\RouteRegex;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [JwtAuthController::class, 'login']);
    Route::post('logout', [JwtAuthController::class, 'logout']);
    Route::post('refresh', [JwtAuthController::class, 'refresh']);
    Route::post('me', [JwtAuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:api'], function () {

    // Flight API resources
    Route::apiResource('flights', FlightController::class)->where([
        'flight' => RouteRegex::UUID
    ])->middleware('auth:api');

    // Album API resources
    Route::apiResource('gallery/albums', AlbumController::class)->where([
        'album' => RouteRegex::UUID
    ])->middleware('auth:api');

    Route::group(['middleware' => 'auth:api', 'prefix' => 'gallery/albums'], function () {
        Route::get('{album}/pictures', [AlbumPictureController::class, 'index'])->where([
            'album' => RouteRegex::UUID
        ]);

        Route::post('{album}/pictures', [AlbumPictureController::class, 'store'])->where([
            'album' => RouteRegex::UUID
        ]);

        Route::get('picture/{picture}', [AlbumPictureController::class, 'show'])->where([
            'picture' => RouteRegex::UUID
        ]);

        Route::patch('picture/{picture}', [AlbumPictureController::class, 'update'])->where([
            'picture' => RouteRegex::UUID
        ]);

        Route::delete('picture/{picture}', [AlbumPictureController::class, 'destroy'])->where([
            'picture' => RouteRegex::UUID
        ]);
    });

    Route::post('/system-config', [SystemConfigController::class, 'fetchConfig']);
    Route::post('/system-config/update', [SystemConfigController::class, 'updateConfig']);
    Route::post('/upload/image', [FileUploadController::class, 'uploadImage']);
});


Route::group(['middleware' => 'auth:api', 'prefix' => 'kanban'], function () {
    Route::apiResource('projects', ProjectController::class)->where([
        'project' => RouteRegex::UUID
    ]);

    Route::get('/projects/{project_uuid}/statuses', [StatusController::class, 'list'])->where([
        'project_uuid' => RouteRegex::UUID
    ]);
});
