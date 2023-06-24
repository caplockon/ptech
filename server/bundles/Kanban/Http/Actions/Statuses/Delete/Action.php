<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Delete;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Repositories\StatusRepository;
use Illuminate\Auth\Access\AuthorizationException;

class Action extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function __invoke(
        string $uuid,
        StatusRepository $statusRepository
    )
    {
        $status = $statusRepository->getByUuidOrFail($uuid);
        $this->authorize('view', $status);

        $statusRepository->delete($status);
        return response()->noContent();
    }
}
