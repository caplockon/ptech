<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Resources;

use Bundles\Kanban\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    public function toArray(Request $request)
    {
        /** @var Status $this */
        return [
            'uuid' => $this->uuid,
            'status' => $this->status,
            'priority' => $this->priority
        ];
    }
}
