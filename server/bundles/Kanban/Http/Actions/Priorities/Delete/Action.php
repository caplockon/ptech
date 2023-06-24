<?php
declare(strict_types=1);

namespace Delete;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Repositories\PriorityRepository;
use Bundles\Kanban\Repositories\StatusRepository;
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
