<?php
declare(strict_types=1);

namespace Bundles\Kanban\Repositories;

use Bundles\Kanban\Models\Status;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository extends Repository
{
    protected string $modelClass = Status::class;

    /**
     * @param string $uuid
     * @return Status|null|mixed
     */
    public function getByUuidOrFail($uuid)
    {
        return Status::query()->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * @param $projectId
     * @return Collection<Status>
     */
    public function getListByProjectID($projectId)
    {
        return Status::query()
            ->where('project_id', $projectId)
            ->orderBy('priority')
            ->get();
    }

    /**
     * @return Collection<Status>
     */
    public function getDefaultListStatuses()
    {
        return $this->getListByProjectID(0);
    }

    /**
     * @param int|int[] $id
     * @return void
     */
    public function deleteByProjectIDWhereNotId($projectId, $id)
    {
        Status::query()
            ->where('project_id', $projectId)
            ->whereNotIn('id', (array) $id)
            ->delete();
    }
}
