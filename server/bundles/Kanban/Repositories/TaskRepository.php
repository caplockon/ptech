<?php
declare(strict_types=1);

namespace Bundles\Kanban\Repositories;

use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Models\Task;

class TaskRepository extends Repository
{
    protected string $modelClass = Task::class;

    public function getListByProject(Project $project)
    {
        return Task::query()
            ->where('project_id', $project->id)
            ->get();
    }
}
