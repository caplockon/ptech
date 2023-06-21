<?php
declare(strict_types=1);

namespace Bundles\Kanban;

use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Policies\ProjectPolicy;
use Closure;
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

        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/Routes/api.php');
    }
}
