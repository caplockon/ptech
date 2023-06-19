<?php
declare(strict_types=1);

namespace App\Policies\Kanban;

use App\Models\Kanban\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project)
    {
        return $project->owner_id === $user->id;
    }
}
