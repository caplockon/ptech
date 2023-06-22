<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Details;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Request;
use Bundles\Kanban\Http\Resources\PriorityResource;
use Bundles\Kanban\Http\Resources\ProjectResource;
use Bundles\Kanban\Http\Resources\StatusResource;
use Bundles\Kanban\Repositories\PriorityRepository;
use Bundles\Kanban\Repositories\StatusRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(
        Request $request,
        StatusRepository $statusRepository,
        PriorityRepository $priorityRepository
    )
    {
        $project = $this->getProject();

        $statusResources = StatusResource::collection($statusRepository->getStatuses($project))
            ->toArray($request);

        $priorityResources = PriorityResource::collection($priorityRepository->getPriorities($project))
            ->toArray($request);

        return (new ProjectResource($project))
            ->append('statuses', $statusResources)
            ->append('priorities', $priorityResources);
    }
}
