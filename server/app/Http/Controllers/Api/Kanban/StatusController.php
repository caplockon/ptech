<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Kanban;

use Bundles\Kanban\Http\Resources\StatusResource;
use Bundles\Kanban\Repositories\ProjectRepository;
use Bundles\Kanban\Repositories\StatusRepository;
use Bundles\Kanban\Services\ProjectService;
use Illuminate\Auth\Access\AuthorizationException;

class StatusController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function list(
        string $project_uuid,
        ProjectRepository $projectRepository,
        StatusRepository $statusRepository,
        ProjectService $projectService
    )
    {
        $project = $projectRepository->getByUuidOrFail($project_uuid);
        $this->authorize('view', $project);

        $statuses = $statusRepository->getListByProjectID($project->id);
        if ($statuses->isEmpty()) {
            $statuses = $projectService->createDefaultStatuses($project);
        }

        return StatusResource::collection($statuses);
    }
}
