<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Statuses;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Resources\StatusResource;
use Bundles\Kanban\Repositories\StatusRepository;
use Bundles\Kanban\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(
        string $uuid,
        StatusRepository $statusRepository,
        ProjectService $projectService
    ) {
        $project = $this->getProject();

        $statuses = $statusRepository->getListByProjectID($project->id);
        if ($statuses->isEmpty()) {
            $statuses = $projectService->createDefaultStatuses($project);
        }

        return StatusResource::collection($statuses);
    }
}
