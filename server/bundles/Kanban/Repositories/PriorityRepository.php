<?php
declare(strict_types=1);

namespace Bundles\Kanban\Repositories;

use Bundles\Kanban\Models\Priority;
use Bundles\Kanban\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PriorityRepository extends Repository
{
    protected string $modelClass = Priority::class;

    /**
     * @param string $uuid
     * @return Priority|mixed
     */
    public function getByUuidOrFail(string $uuid)
    {
        return Priority::query()
            ->where('uuid', $uuid)
            ->firstOrFail();
    }

    /**
     * @param $projectId
     * @return Collection<Priority>
     */
    public function getListByProjectId($projectId)
    {
        return Priority::query()
            ->where('project_id', $projectId)
            ->orderBy('order')
            ->get();
    }

    /**
     * @return Collection<Priority>
     */
    public function getDefaultProrityList()
    {
        return $this->getListByProjectId(0);
    }

    /**
     * @param int $projectId
     * @param int|int[] $ignoreId
     * @return void
     */
    public function deleteByProjectIdWhereNotIds($projectId, $ignoreId)
    {
        Priority::query()
            ->where('project_id', $projectId)
            ->whereNotIn('id', (array) $ignoreId)
            ->delete();
    }

    /**
     * Return statuses of a project
     *
     * @param Project $project
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getPriorities(Project $project)
    {
        $statuses = $this->getListByProjectId($project->id);

        if ($statuses->isEmpty()) {
            $statuses = $this->createDefaultPriorities($project);
        }

        return $statuses;
    }

    /**
     * Create default priorities for a project
     *
     * @param Project $project
     * @return \Illuminate\Support\Collection
     */
    protected function createDefaultPriorities(Project $project)
    {

        $defaults = $this->getDefaultProrityList();
        return $defaults->map(function (Priority $default) use ($project) {

            $priority = new Priority();
            $priority->fill($default->toArray());
            $priority->uuid = Str::uuid();
            $priority->project_id = $project->id;
            $priority->save();

            return $priority;
        });
    }

    public function getMaxOrderByProject($projectId)
    {
        return (int) Priority::query()
            ->where('project_id', $projectId)
            ->max('order');
    }
}
