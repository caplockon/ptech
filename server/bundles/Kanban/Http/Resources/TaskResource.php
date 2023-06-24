<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Resources;

use App\Http\Resources\UserResource;
use Bundles\Kanban\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request)
    {
        /** @var Task $this */
        $assignee = $this->assignee()->first();
        $status = $this->status()->first();
        $priority = $this->priority()->first();

        return [
            'uuid'          => $this->uuid,
            'name'          => $this->name,
            'description'   => $this->description,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'creator'       => new UserResource($this->creator()->firstOrFail()),
            'assignee'      => $assignee ? new UserResource($assignee) : null,
            'status'        => $status ? new StatusResource($status) : null,
            'priority'      => $priority ? new PriorityResource($priority) : null,
        ];
    }
}
