<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FlightCreateRequest;
use App\Http\Requests\Api\FlightUpdateRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use App\Repositories\FlightRepository;

class FlightController extends Controller
{
    public function __construct(
        private FlightRepository $flightRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FlightResource::collection($this->flightRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightCreateRequest $request)
    {
        $validated = $request->validated();
        $flight = $this->flightRepository->persist($validated);
        return FlightResource::make($flight);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return FlightResource::make($flight);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(FlightUpdateRequest $request, Flight $flight)
    {
        $flight->fill($request->validated());
        $this->flightRepository->persist($flight);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $this->flightRepository->delete($flight);
        return response()->noContent();
    }
}
