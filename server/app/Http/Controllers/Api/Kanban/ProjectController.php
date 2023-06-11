<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Kanban;

use App\Http\Resources\Kanban\ProjectResource;
use App\Models\Kanban\Project;
use App\Models\User;

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
    public function store()
    {
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
    public function update()
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
    }
}
