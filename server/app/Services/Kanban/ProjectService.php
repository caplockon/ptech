<?php
declare(strict_types=1);

namespace App\Services\Kanban;

use App\Models\Kanban\Project;
use App\Models\Kanban\Status;
use App\Repositories\Kanban\StatusRepository;
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
