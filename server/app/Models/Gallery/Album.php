<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $id
 * @property string|null $uuid
 * @property string|null $name
 * @property string|null $description
 * @property int|null $owner_id
 * @property int $created_at
 * @property int $updated_at
 */
class Album extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';

    protected $table = 'gallery_albums';

    protected $fillable = [
        'name',
        'description'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'album_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasOne(Picture::class, 'album_id', 'id')->latest();
    }
}
