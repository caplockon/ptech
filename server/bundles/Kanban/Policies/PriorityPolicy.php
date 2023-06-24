<?php
declare(strict_types=1);

namespace Bundles\Kanban\Policies;

use App\Models\User;
use Bundles\Kanban\Models\Priority;
use Bundles\Kanban\Repositories\ProjectRepository;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class PriorityPolicy
{
    public function view(User $user, Priority $priority)
    {
        /** @var ProjectRepository $repo */
        $repo = app(ProjectRepository::class);
        $project = $repo->getOneByID($priority->project_id);

        if (! $project) {
            return Response::deny("No project linked to priority");
        }

        return Gate::inspect('view', $project);
    }
}
