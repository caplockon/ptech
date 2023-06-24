<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Statuses\Update;

use Bundles\Kanban\Http\Request;

class UpdatePriorityRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'  => 'string|min:2',
            'order' => 'int|min:1'
        ];
    }
}
