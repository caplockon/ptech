<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Create;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Resources\StatusResource;
use Bundles\Kanban\Models\Status;
use Bundles\Kanban\Repositories\StatusRepository;
use Illuminate\Support\Str;

class Action extends ProjectAction
{
    protected string $projectParamName = 'project_uuid';

    public function __invoke(CreateStatusRequest $request, StatusRepository $statusRepository)
    {
        $project = $this->getProject();
        $status = new Status();
        $status->fill($request->validated());
        $status->project_id = $project->id;

        $priority = $status->priority;
        if (empty($priority)) {
            $status->priority = $statusRepository->getMaxPriorityByProject($project);
        }
        $status->uuid = Str::uuid();

        $statusRepository->persist($status);
        return new StatusResource($status);
    }
}
