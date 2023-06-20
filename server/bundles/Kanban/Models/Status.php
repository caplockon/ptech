<?php
declare(strict_types=1);

namespace Bundles\Kanban\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string|null $uuid
 * @property string|null $status
 * @property int|null $priority
 * @property int|null $project_id
 */
class Status extends Model
{
    /**
     * Table of model.
     * @var string
     */
    protected $table = 'project_statuses';

    /**
     * List of fields can be filled.
     * @var string[]
     */
    protected $fillable = [
        'status',
        'priority'
    ];

    /**
     * This table does not track timestamps
     * @var bool
     */
    public $timestamps = false;
}
