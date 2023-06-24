<?php
declare(strict_types=1);

namespace Bundles\Kanban;

use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Models\Status;
use Bundles\Kanban\Policies\ProjectPolicy;
use Bundles\Kanban\Policies\StatusPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/Routes/api.php');

        Gate::policy(Project::class, ProjectPolicy::class);
        Gate::policy(Status::class, StatusPolicy::class);

        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/Routes/api.php');
    }
}
