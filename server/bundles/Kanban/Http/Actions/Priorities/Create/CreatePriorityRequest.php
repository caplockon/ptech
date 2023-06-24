<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Priorities\Create;

use Bundles\Kanban\Http\Request;

/**
 * @property string $status
 * @property int|null $priority
 * @property string $project_uuid
 */
class CreatePriorityRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'order' => 'int|min:1',
            'project_uuid' => 'required|string'
        ];
    }
}
