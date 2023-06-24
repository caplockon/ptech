<?php
declare(strict_types=1);

namespace Bundles\Kanban\Policies;

use App\Models\User;
use Bundles\Kanban\Models\Status;
use Bundles\Kanban\Repositories\ProjectRepository;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class StatusPolicy
{
    public function view(User $user, Status $status)
    {
        /** @var ProjectRepository $repo */
        $repo = app(ProjectRepository::class);
        $project = $repo->getOneByID($status->project_id);

        if (! $project) {
            return Response::deny("No project linked to status");
        }

        return Gate::inspect('view', $project);
    }
}
