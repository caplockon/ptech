<?php
declare(strict_types=1);

namespace App\Http\Resources\Kanban;

use App\Models\Kanban\Status;
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
