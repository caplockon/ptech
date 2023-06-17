<?php
declare(strict_types=1);

namespace App\Repositories\Kanban;

use App\Models\Kanban\Project;
use App\Repositories\Repository;

class ProjectRepository extends Repository
{
    protected string $modelClass = Project::class;

    /**
     * @param string $uuid
     * @return Project|mixed
     */
    public function getByUuidOrFail(string $uuid)
    {
        return Project::query()->where('uuid', $uuid)->firstOrFail();
    }
}
