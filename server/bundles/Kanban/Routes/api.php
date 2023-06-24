<?php

use App\Http\RouteRegex;
use Bundles\Kanban\Http\Actions\Projects as ProjectActions;
use Bundles\Kanban\Http\Actions\Statuses as StatusActions;
use Bundles\Kanban\Http\Actions\Priorities as PriorityActions;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api', 'prefix' => 'kanban'], function () {

    Route::get(
        '/projects',
        ProjectActions\List\Action::class
    );

    Route::get(
        '/projects/{uuid}',
        ProjectActions\Details\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::get(
        '/board/{code}',
        ProjectActions\Board\Action::class
    );

    Route::post(
        '/projects',
        ProjectActions\Create\Action::class
    );

    Route::patch(
        '/projects/{uuid}',
        ProjectActions\Update\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::delete(
        '/projects/{uuid}',
        ProjectActions\Delete\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::get(
        '/projects/{uuid}/statuses',
        ProjectActions\Statuses\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::put(
        '/projects/{uuid}/statuses',
        ProjectActions\UpdateStatuses\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::get(
        '/projects/{uuid}/priorities',
        ProjectActions\Priorities\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::put(
        '/projects/{uuid}/priorities',
        ProjectActions\UpdatePriorities\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::post(
        '/statuses',
        StatusActions\Create\Action::class
    );

    Route::delete(
        '/statuses/{uuid}',
        StatusActions\Delete\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::patch(
        '/statuses/{uuid}',
        StatusActions\Update\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::post(
        '/priorities',
        PriorityActions\Create\Action::class
    );

    Route::delete(
        '/priorities/{uuid}',
        PriorityActions\Delete\Action::class
    )->where(['uuid' => RouteRegex::UUID]);

    Route::patch(
        '/priorities/{uuid}',
        PriorityActions\Update\Action::class
    )->where(['uuid' => RouteRegex::UUID]);
});

