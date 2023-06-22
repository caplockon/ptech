<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects\Create;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Http\Resources\ProjectResource;
use Bundles\Kanban\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Action extends Controller
{
    public function __invoke(CreateProjectRequest $request)
    {
        $attrs = $request->validated();

        $project = new Project();
        $project->fill($attrs);
        $project->uuid = Str::uuid();
        $project->created_at = Carbon::now();
        $project->updated_at = Carbon::now();
        $project->owner_id = ensure_having(auth()->user())->id;
        $project->save();

        return (new ProjectResource($project))->additional([
            'success' => true,
            'message' => 'Project has been created successfully'
        ]);
    }
}
