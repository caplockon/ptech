<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Update;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Repositories\ProjectRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(ProjectRepository $repository, UpdateProjectRequest $request)
    {
        $project = $this->getProject();
        $project->fill($request->validated());
        $repository->persist($project);
        return response()->noContent();
    }
}
