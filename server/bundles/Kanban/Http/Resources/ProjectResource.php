<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Resources;

use Bundles\Kanban\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * @var array
     */
    protected array $more = [];


    public function toArray(Request $request)
    {
        /** @var Project $this */
        return array_merge([
            'uuid' => $this->uuid,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], $this->more);
    }

    /**
     * @param $name
     * @param $data
     * @return $this
     */
    public function append($name, $data)
    {
        $this->more[$name] = $data;
        return $this;
    }
}
