<?php
declare(strict_types=1);

namespace Bundles\Kanban\Http\Actions\Projects;

use Bundles\Kanban\Http\Controller;
use Bundles\Kanban\Models\Project;
use Bundles\Kanban\Repositories\ProjectRepository;
use Illuminate\Auth\Access\AuthorizationException;

abstract class ProjectAction extends Controller
{
    /**
     * Name of project parameter name
     * @var string
     */
    protected string $projectParamName = 'uuid';

    /**
     * Check to see if we need to authorize the resource
     * @var string|null
     */
    protected ?string $authorization = 'view';

    /**
     * @return Project
     * @throws AuthorizationException
     */
    protected function getProject(): Project
    {
        /** @var ProjectRepository $repo */
        $repo = app(ProjectRepository::class);

        $project = $repo->getByUuidOrFail(request($this->projectParamName));
        $this->authorization && $this->authorize($this->authorization, $project);

        return $project;
    }
}
