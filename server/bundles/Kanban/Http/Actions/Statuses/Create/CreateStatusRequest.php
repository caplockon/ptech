<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Create;

use Bundles\Kanban\Http\Request;

/**
 * @property string $status
 * @property int|null $priority
 * @property string $project_uuid
 */
class CreateStatusRequest extends Request
{
    public function rules(): array
    {
        return [
            'status' => 'required|string|min:2',
            'priority' => 'int|min:1',
            'project_uuid' => 'required|string'
        ];
    }
}
