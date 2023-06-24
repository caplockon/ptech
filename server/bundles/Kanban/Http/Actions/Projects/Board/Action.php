<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Board;

use App\Models\User;
use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Http\Resources\ProjectResource;
use Bundles\Kanban\Repositories\ProjectRepository;

class Action extends Controller
{
    public function __invoke(
        string $code,
        ProjectRepository $projectRepository
    )
    {
        /** @var User $user */
        $user = auth()->user();
        $project = $projectRepository->getByCodeUserOrFail($code, $user);
        return (new ProjectResource($project))
            ->includeStatuses()
            ->includePriorities()
            ->includeTasks();
    }
}
