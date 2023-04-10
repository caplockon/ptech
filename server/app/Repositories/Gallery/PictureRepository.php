<?php

namespace App\Repositories\Gallery;

use App\Models\Gallery\Picture;
use App\Repositories\Repository;

class PictureRepository extends Repository
{
    protected string $modelClass = Picture::class;
}
