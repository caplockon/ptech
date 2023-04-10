<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $id
 * @property string|null $uuid
 * @property string|null $title
 * @property string|null $description
 * @property string|null $system_path
 * @property int|null $album_id
 * @property int $created_at
 * @property int $updated_at
 */
class Picture extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';

    protected $table = 'gallery_pictures';

    protected $fillable = [
        'title',
        'description'
    ];
}
