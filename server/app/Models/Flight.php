<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    use HasUuids;
    use HasTimestamps;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name',
        'description'
    ];
}
