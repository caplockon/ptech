<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\UpdatePriorities;

use Bundles\Kanban\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @property array[] $priorities
 */
class UpdatePrioritiesRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'priorities' => ['required', 'array', 'min:1', fn () => $this->validatePriorityItems()],
        ];
    }

    private function validatePriorityItems()
    {
        $priorities = $this->get('priorities');

        $rules = [
            'name'      => 'required|string',
            'order'     => 'required|int',
            'uuid'      => 'string'
        ];

        return collect($priorities)->map(function ($priority) use ($rules) {
            return Validator::validate($priority, $rules);
        });
    }
}
