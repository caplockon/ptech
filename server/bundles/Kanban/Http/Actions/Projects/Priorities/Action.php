<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Priorities;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Resources\PriorityResource;
use Bundles\Kanban\Repositories\PriorityRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(PriorityRepository $priorityRepository)
    {
        return PriorityResource::collection(
            $priorityRepository->getPriorities($this->getProject())
        );
    }
}
