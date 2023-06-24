<?php
declare(strict_types=1);

namespace Bundles\Kanban\Repositories;

use App\Models\User;
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

    /**
     * @param string $code
     * @param User $user
     * @return Project|mixed
     */
    public function getByCodeUserOrFail(string $code, User $user)
    {
        return Project::query()
            ->where('code', $code)
            ->where('owner_id', $user->id)
            ->firstOrFail();
    }
}
