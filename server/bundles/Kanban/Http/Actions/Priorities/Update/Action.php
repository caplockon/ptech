<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Update;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Repositories\PriorityRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(
        string                $uuid,
        UpdatePriorityRequest $request,
        PriorityRepository    $priorityRepository
    )
    {
        $priority = $priorityRepository->getByUuidOrFail($uuid);
        $this->authorize('view', $priority);

        $priority->fill($request->validated());
        $priorityRepository->persist($priority);
        return response()->noContent();
    }
}
