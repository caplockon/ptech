<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Priorities\Delete;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Repositories\PriorityRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(
        string $uuid,
        PriorityRepository $priorityRepository
    )
    {
        $priority = $priorityRepository->getByUuidOrFail($uuid);
        $this->authorize('view', $priority);

        $priorityRepository->delete($priority);
        return response()->noContent();
    }
}
