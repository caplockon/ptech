<?php

namespace App\Repositories\Gallery;

use App\Models\Gallery\Album;
use App\Models\Gallery\Picture;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;

class AlbumRepository extends Repository
{
    protected string $modelClass = Album::class;

    /**
     * @param User $user
     * @return array<Album>|Collection<Album>
     */
    public function getListByUser(User $user)
    {
        return Album::query()->where('owner_id', $user->id)->get();
    }

    /**
     * @param Album $album
     * @return array<Picture>|Collection<Picture>
     */
    public function getPictureListByAlbum(Album $album)
    {
        return $album->pictures()->get();
    }
}
