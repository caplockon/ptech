<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Delete;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Repositories\ProjectRepository;

class Action extends Controller
{
    public function __invoke(string $project, ProjectRepository $repository)
    {
        $repository->delete($repository->getByUuidOrFail($project));
        return response()->noContent();
    }
}
