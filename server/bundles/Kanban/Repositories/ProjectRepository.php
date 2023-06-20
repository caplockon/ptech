<?php
declare(strict_types=1);

namespace Bundles\Kanban\Repositories;

use App\Repositories\Repository;
use Bundles\Kanban\Models\Project;

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
