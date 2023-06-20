<?php
declare(strict_types=1);

namespace Bundles\Kanban\Services;

use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Models\Status;
use Bundles\Kanban\Repositories\StatusRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProjectService
{
    /**
     * Create default statues for a project
     *
     * @param Project $project
     * @return Collection
     */
    public function createDefaultStatuses(Project $project)
    {
        /** @var StatusRepository $repo */
        $repo = app(StatusRepository::class);

        $defaultStatues = $repo->getDefaultListStatuses();
        return $defaultStatues->map(function (Status $defaultStatus) use ($project) {

            $status = new Status();
            $status->fill($defaultStatus->toArray());
            $status->uuid = Str::uuid();
            $status->project_id = $project->id;
            $status->save();

            return $status;
        });
    }
}
