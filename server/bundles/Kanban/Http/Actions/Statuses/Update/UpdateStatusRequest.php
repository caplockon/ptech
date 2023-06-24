<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Update;

use Bundles\Kanban\Http\Request;

class UpdateStatusRequest extends Request
{
    public function rules(): array
    {
        return [
            'status' => 'string|min:2',
            'priority' => 'int|min:1'
        ];
    }
}
