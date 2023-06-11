<?php
declare(strict_types=1);

namespace App\Models\Kanban;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int|null $id
 * @property string|null $uuid
 * @property string|null $code
 * @property string|null $name
 * @property int|null $owner_id
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Project extends Model
{
    /**
     * The name of table
     * @var string
     */
    protected $table = 'projects';

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'description',
    ];
}
