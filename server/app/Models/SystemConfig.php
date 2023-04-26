<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $id
 * @property string|null $name
 * @property mixed|null $value
 * @property string|null $type
 */
class SystemConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'value'
    ];
}
