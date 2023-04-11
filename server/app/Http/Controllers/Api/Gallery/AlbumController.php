<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gallery\AlbumCreateRequest;
use App\Http\Requests\Api\Gallery\AlbumUpdateRequest;
use App\Http\Resources\Gallery\AlbumResource;
use App\Models\Gallery\Album;
use App\Models\User;
use App\Repositories\Gallery\AlbumRepository;

class AlbumController extends Controller
{
    public function __construct(
        private AlbumRepository $albumRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        return AlbumResource::collection($this->albumRepository->getListByUser($user));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumCreateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $album = new Album($request->validated());
        $album->owner_id = $user->id;
        $this->albumRepository->persist($album);
        return AlbumResource::make($album);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return AlbumResource::make($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumUpdateRequest $request, Album $album)
    {
        $album->fill($request->validated());
        $this->albumRepository->persist($album);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $this->albumRepository->delete($album);
        return response()->noContent();
    }
}
