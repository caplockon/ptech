<?php
declare(strict_types=1);


use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Resources\PriorityResource;
use Bundles\Kanban\Models\Priority;
use Bundles\Kanban\Repositories\PriorityRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;

class Action extends ProjectAction
{
    protected string $projectParamName = 'project_uuid';

    /**
     * @throws AuthorizationException
     */
    public function __invoke(CreatePriorityRequest $request, PriorityRepository $priorityRepository)
    {
        $project = $this->getProject();

        $priority = new Priority();
        $priority->fill($request->validated());
        $priority->project_id = $project->id;

        $order = $priority->order;
        if (empty($order)) {
            $priority->order = $priorityRepository->getMaxOrderByProject($project) + 1;
        }
        $priority->uuid = Str::uuid();

        $priorityRepository->persist($priority);
        return new PriorityResource($priority);
    }
}
