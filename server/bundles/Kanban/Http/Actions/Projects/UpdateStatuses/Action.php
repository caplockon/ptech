<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\UpdateStatuses;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Models\Status;
use Bundles\Kanban\Repositories\StatusRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Throwable;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function __invoke(
        UpdateStatusRequest $request,
        StatusRepository $statusRepository
    )
    {
        $project = $this->getProject();

        $ids = collect($request->statuses)->map(function (array $statusData) use ($project, $statusRepository) {
            $uuid = $statusData['uuid'] ?? null;

            if ($uuid) {
                $status = $statusRepository->getByUuidOrFail($uuid);
                throw_if($status->project_id != $project->id, ModelNotFoundException::class);
                $status->fill($statusData);
            } else {
                $status = new Status();
                $status->fill($statusData);
                $status->uuid = Str::uuid();
                $status->project_id = $project->id;
            }

            $statusRepository->persist($status);
            return $status->id;
        })->all();

        $statusRepository->deleteByProjectIDWhereNotId($project->id, $ids);
        return response()->noContent();
    }
}
