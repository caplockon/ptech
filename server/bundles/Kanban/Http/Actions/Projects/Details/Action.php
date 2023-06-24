<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Details;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Http\Resources\ProjectResource;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke()
    {
        return (new ProjectResource($this->getProject()))
            ->includeStatuses()
            ->includePriorities();
    }
}
