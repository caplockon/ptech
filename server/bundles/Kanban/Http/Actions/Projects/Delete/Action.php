<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Delete;

use Bundles\Kanban\Http\Actions\Projects\ProjectAction;
use Bundles\Kanban\Repositories\ProjectRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends ProjectAction
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(ProjectRepository $repository)
    {
        $repository->delete($this->getProject());
        return response()->noContent();
    }
}
