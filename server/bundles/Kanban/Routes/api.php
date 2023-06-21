<?php

use App\Http\RouteRegex;
use Bundles\Kanban\Http\Actions\Projects as ProjectActions;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'prefix' => 'kanban'], function () {

    Route::get(
        '/projects',
        ProjectActions\List\Action::class
    );

    Route::post(
        '/projects',
        ProjectActions\Create\Action::class
    );

    Route::patch(
        '/projects/{uuid}',
        ProjectActions\Update\Action::class
    )->where([
        'uuid' => RouteRegex::UUID
    ]);

    Route::delete(
        '/projects/{uuid}',
        ProjectActions\Delete\Action::class
    )->where([
        'uuid' => RouteRegex::UUID
    ]);

    Route::get(
        '/projects/{uuid}/statuses',
        ProjectActions\Statuses\Action::class
    )->where([
        'uuid' => RouteRegex::UUID
    ]);


    Route::put(
        '/projects/{uuid}/statuses',
        ProjectActions\UpdateStatuses\Action::class
    )->where([
        'uuid' => RouteRegex::UUID
    ]);
});

