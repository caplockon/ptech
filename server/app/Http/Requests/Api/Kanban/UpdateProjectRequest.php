<?php
declare(strict_types=1);

namespace App\Http\Requests\Api\Kanban;

use App\Http\Requests\Api\Request;
use App\Models\Kanban\Project;
use Illuminate\Validation\Rule;

/**
 * @property string $uuid
 * @property string $code
 * @property string $name
 * @property string|null $description
 */
class UpdateProjectRequest extends Request
{
    public function rules(): array
    {
        return [
            'code' => [
                'string',
                Rule::unique(table_of(Project::class))
                    ->withoutTrashed()
                    ->where('code', $this->code)
                    ->where('owner_id', ensure_having($this->user())->id)
                    ->whereNot('uuid', $this->uuid)
            ],
            'name' => [
                'string',
                'min:5'
            ],
            'description' => [
                'string',
            ]
        ];
    }
}
