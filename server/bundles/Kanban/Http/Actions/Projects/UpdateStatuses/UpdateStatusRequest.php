<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\UpdateStatuses;

use Bundles\Kanban\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @property array[] $statuses
 */
class UpdateStatusRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'statuses' => ['required', 'array', 'min:1', fn () => $this->validateStatusItems()],
        ];
    }

    private function validateStatusItems()
    {
        $statuses = $this->get('statuses');

        $rules = [
            'status'    => 'required|string',
            'priority'  => 'required|int',
            'uuid'      => 'string'
        ];

        return collect($statuses)->map(function ($status) use ($rules) {
            return Validator::validate($status, $rules);
        });
    }
}
