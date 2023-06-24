<?php
declare(strict_types=1);

namespace Bundles\Kanban\Repositories;

use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class StatusRepository extends Repository
{
    /**
     * @var string
     */
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

    /**
     * Return statuses of a project
     *
     * @param Project $project
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getStatuses(Project $project)
    {
        $statuses = $this->getListByProjectID($project->id);

        if ($statuses->isEmpty()) {
            $statuses = $this->createDefaultStatuses($project);
        }

        return $statuses;
    }


    /**
     * Create default statues for a project
     *
     * @param Project $project
     * @return Collection
     */
    protected function createDefaultStatuses(Project $project)
    {
        $defaultStatues = $this->getDefaultListStatuses();
        return $defaultStatues->map(function (Status $defaultStatus) use ($project) {

            $status = new Status();
            $status->fill($defaultStatus->toArray());
            $status->uuid = Str::uuid();
            $status->project_id = $project->id;
            $status->save();

            return $status;
        });
    }

    public function getMaxPriorityByProject(Project $project)
    {
        return 1 + (int) Status::query()
                ->where('project_id', $project->id)
                ->max('priority');
    }
}
