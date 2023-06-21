<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Statuses;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Http\Resources\StatusResource;
use Bundles\Kanban\Repositories\ProjectRepository;
use Bundles\Kanban\Repositories\StatusRepository;
use Bundles\Kanban\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(
        string $uuid,
        ProjectRepository $projectRepository,
        StatusRepository $statusRepository,
        ProjectService $projectService
    ) {
        $project = $projectRepository->getByUuidOrFail($uuid);
        $this->authorize('view', $project);

        $statuses = $statusRepository->getListByProjectID($project->id);
        if ($statuses->isEmpty()) {
            $statuses = $projectService->createDefaultStatuses($project);
        }

        return StatusResource::collection($statuses);
    }
}
