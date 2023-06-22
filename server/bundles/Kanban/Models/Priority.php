<?php
declare(strict_types=1);

namespace Bundles\Kanban\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int|null $id
 * @property string|null $uuid
 * @property string|null $name
 * @property int|null $project_id
 * @property int|null $order
 */
class Priority extends Model
{
    protected $table = 'project_priorities';

    public $timestamps = false;

    protected $fillable = [
        'name', 'order'
    ];
}
