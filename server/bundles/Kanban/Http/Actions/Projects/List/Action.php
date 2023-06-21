<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\List;

use App\Models\User;
use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Http\Resources\ProjectResource;
use Bundles\Kanban\Models\Project;

class Action extends Controller
{
    public function __invoke()
    {
        /** @var User $user */
        $user = ensure_having(auth()->user());
        return ProjectResource::collection(
            Project::query()->where('owner_id', $user->id)->get()
        );
    }
}
