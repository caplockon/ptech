<?php
declare(strict_types=1);

namespace Bundles\Kanban\Policies;

use App\Models\User;
use Bundles\Kanban\Models\Project;

class ProjectPolicy
{
    public function view(User $user, Project $project)
    {
        return $project->owner_id === $user->id;
    }
}
