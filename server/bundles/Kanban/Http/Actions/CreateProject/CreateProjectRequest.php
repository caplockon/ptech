<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\CreateProject;

use Bundles\Kanban\Http\Request;
use Bundles\Kanban\Models\Project;
use Illuminate\Validation\Rule;

/**
 * @property string $code
 * @property string $name
 * @property string|null $description
 */
class CreateProjectRequest extends Request
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                Rule::unique(table_of(Project::class))
                    ->withoutTrashed()
                    ->where('code', $this->code)
                    ->where('owner_id', ensure_having($this->user())->id)
            ],
            'name' => [
                'required',
                'string',
                'min:5'
            ],
            'description' => [
                'string',
            ]
        ];
    }
}
