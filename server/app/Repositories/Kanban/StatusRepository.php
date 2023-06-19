<?php
declare(strict_types=1);

namespace App\Repositories\Kanban;

use App\Models\Kanban\Status;
use App\Repositories\Repository;

class StatusRepository extends Repository
{
    protected string $modelClass = Status::class;

    public function getListByProjectID($projectId)
    {
        return Status::query()->where('project_id', $projectId)->get();
    }

    public function getDefaultListStatuses()
    {
        return $this->getListByProjectID(0);
    }
}
