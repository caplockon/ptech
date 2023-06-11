<?php
declare(strict_types=1);

namespace App\Models\Kanban;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $id
 * @property string|null $uuid
 * @property string|null $code
 * @property string|null $name
 * @property int|null $owner_id
 * @property string|null $description
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 */
class Project extends Model
{
    /**
     * The name of table
     * @var string
     */
    protected $table = 'projects';
}
