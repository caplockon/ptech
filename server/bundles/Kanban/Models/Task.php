<?php
declare(strict_types=1);

namespace Bundles\Kanban\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int|null $id
 * @property string|null $uuid
 * @property string|null $name
 * @property string|null $description
 * @property int|null $project_id
 * @property int|null $creator_id
 * @property int|null $assignee_id
 * @property int|null $status_id
 * @property int|null $priority_id
 * @property-read Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Carbon|null  $deleted_at
 */
class Task extends Model
{
    protected $table = 'project_tasks';

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id', 'id');
    }
}
