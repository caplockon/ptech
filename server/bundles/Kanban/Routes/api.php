<?php

use App\Http\RouteRegex;
use Illuminate\Support\Facades\Route;
use Bundles\Kanban\Http\Actions as Actions;

Route::group(['middleware' => 'auth:api', 'prefix' => 'kanban'], function () {

    Route::get('/projects', Actions\ListProject\Action::class);
    Route::post('/projects', Actions\CreateProject\Action::class);
    Route::patch('/projects/{uuid}', Actions\UpdateRequest\Action::class)->where([
        'uuid' => RouteRegex::UUID
    ]);
    Route::delete('/projects/{uuid}', Actions\DeleteProject\Action::class)->where([
        'uuid' => RouteRegex::UUID
    ]);
});
