<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\UpdateRequest;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Repositories\ProjectRepository;

class Action extends Controller
{
    public function __invoke(string $project, ProjectRepository $repository, UpdateProjectRequest $request)
    {
        $instance = $repository->getByUuidOrFail($project);
        $instance->fill($request->validated());
        $repository->persist($instance);
        return response()->noContent();
    }
}
