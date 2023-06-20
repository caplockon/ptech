<?php
declare(strict_types=1);

namespace Bundles\Kanban\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'task_comments';
}
