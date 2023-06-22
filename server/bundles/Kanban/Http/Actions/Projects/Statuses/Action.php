<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Statuses;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Resources\StatusResource;
use Bundles\Kanban\Repositories\StatusRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(StatusRepository $statusRepository)
    {
        return StatusResource::collection(
            $statusRepository->getStatuses($this->getProject())
        );
    }
}
