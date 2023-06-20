<?php
declare(strict_types=1);

namespace Bundles\Kanban;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function booted(Closure $callback)
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/Routes/api.php');
    }
}
