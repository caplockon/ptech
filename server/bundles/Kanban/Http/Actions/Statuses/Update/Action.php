<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Update;

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
        UpdateStatusRequest $request,
        StatusRepository $statusRepository
    )
    {
        $status = $statusRepository->getByUuidOrFail($uuid);
        $this->authorize('view', $status);

        $status->fill($request->validated());
        $statusRepository->persist($status);
        return response()->noContent();
    }
}
