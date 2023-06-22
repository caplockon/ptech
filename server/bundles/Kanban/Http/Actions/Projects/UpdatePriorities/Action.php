<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\UpdatePriorities;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Models\Priority;
use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Repositories\PriorityRepository;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;

class Action extends ProjectAction
{
    public function __construct(
        private PriorityRepository $priorityRepository
    ) {}

    public function __invoke(UpdatePrioritiesRequest $request)
    {
        $project = $this->getProject();

        $ids = collect($request->priorities)->map(function ($priorityData) use ($project) {
            $uuid = $priorityData['uuid'] ?? null;
            $priority = empty($uuid)
                ? $this->createPriority($project, $priorityData)
                : $this->updatePriority($project, $uuid, $priorityData);

            return $priority->id;
        })->all();

        $this->priorityRepository->deleteByProjectIdWhereNotIds($project->id, $ids);
        return response()->noContent();
    }

    private function createPriority(Project $project, $data)
    {
        $priority = new Priority();
        $priority->fill($data);
        $priority->uuid = Str::uuid();
        $priority->project_id = $project->id;

        $this->priorityRepository->persist($priority);
        return $priority;
    }

    private function updatePriority(Project $project, string $uuid, $data)
    {
        $priority = $this->priorityRepository->getByUuidOrFail($uuid);
        if ($priority->project_id != $project->id) {
            throw new UnauthorizedException("Cannot access resource");
        }

        $priority->fill($data);

        $this->priorityRepository->persist($priority);
        return $priority;
    }
}
