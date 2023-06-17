<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Kanban;

use App\Http\Requests\Api\Kanban\CreateProjectRequest;
use App\Http\Requests\Api\Request;
use App\Http\Resources\Kanban\ProjectResource;
use App\Models\Kanban\Project;
use App\Models\User;
use App\Repositories\Kanban\ProjectRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = ensure_having(auth()->user());
        return ProjectResource::collection(
            Project::query()->where('owner_id', $user->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
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

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Project $project)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $project, ProjectRepository $repository)
    {
        $repository->delete($repository->getByUuidOrFail($project));
        return response()->noContent();
    }
}
