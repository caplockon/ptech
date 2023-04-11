<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gallery\AlbumPictureCreateRequest;
use App\Http\Requests\Api\Gallery\AlbumPictureUpdateRequest;
use App\Http\Resources\Gallery\PictureResource;
use App\Models\Gallery\Album;
use App\Models\Gallery\Picture;
use App\Repositories\Gallery\AlbumRepository;
use App\Repositories\Gallery\PictureRepository;
use Illuminate\Http\Request;

class AlbumPictureController extends Controller
{
    public function __construct(
        private AlbumRepository $albumRepository,
        private PictureRepository $pictureRepository
    ) {}

    /**
     * @param Album $album
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Album $album)
    {
        return PictureResource::collection($this->albumRepository->getPictureListByAlbum($album));
    }

    /**
     * @param AlbumPictureCreateRequest $request
     * @param Album $album
     * @return PictureResource
     */
    public function store(AlbumPictureCreateRequest $request, Album $album)
    {
        $picture = new Picture($request->validated());
        $picture->system_path = '12344';
        $picture->album_id = $album->id;
        $this->pictureRepository->persist($picture);
        return PictureResource::make($picture);
    }

    public function show(Picture $picture)
    {
        return PictureResource::make($picture);
    }

    public function update(AlbumPictureUpdateRequest $request, Picture $picture)
    {
        $picture->fill($request->validated());
        $this->pictureRepository->persist($picture);
        return response()->noContent();
    }

    public function destroy(Picture $picture)
    {
        $this->pictureRepository->delete($picture);
        return response()->noContent();
    }
}
