<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Resources;

use Bundles\Kanban\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriorityResource extends JsonResource
{
    public function toArray(Request $request)
    {
        /** @var Priority $this */
        return [
            'uuid'  => $this->uuid,
            'name'  => $this->name,
            'order' => $this->order,
        ];
    }
}
