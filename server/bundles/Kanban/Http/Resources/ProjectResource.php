<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Resources;

use App\Concerns\Making;
use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Repositories\PriorityRepository;
use Bundles\Kanban\Repositories\StatusRepository;
use Bundles\Kanban\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    use Making;

    /**
     * @var array
     */
    protected array $included = [];


    public function toArray(Request $request)
    {
        /** @var Project $this */
        $data = [
            'uuid' => $this->uuid,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($this->isIncluded('statuses')) {
            $data['statuses'] = StatusResource::collection(
                $this->new(StatusRepository::class)->getStatuses($this->resource)
            )->toArray($request);
        }

        if ($this->isIncluded('priorities')) {
            $data['priorities'] = PriorityResource::collection(
                $this->new(PriorityRepository::class)->getPriorities($this->resource)
            )->toArray($request);
        }

        if ($this->isIncluded('tasks')) {
            $data['tasks'] = TaskResource::collection(
                $this->new(TaskRepository::class)->getListByProject($this->resource)
            )->toArray($request);
        }

        return $data;
    }

    /**
     * @param string $name
     * @param bool $default
     * @return bool
     */
    public function isIncluded(string $name, bool $default = false)
    {
        return $this->included[$name] ?? $default;
    }

    /**
     * @param bool $indicator
     * @return static
     */
    public function includeStatuses(bool $indicator = true)
    {
        $this->included['statuses'] = $indicator;
        return $this;
    }

    /**
     * @param bool $indicator
     * @return static
     */
    public function includePriorities(bool $indicator = true)
    {
        $this->included['priorities'] = $indicator;
        return $this;
    }

    /**
     * @param bool $indicator
     * @return $this
     */
    public function includeTasks(bool $indicator = true)
    {
        $this->included['tasks'] = $indicator;
        return $this;
    }
}
