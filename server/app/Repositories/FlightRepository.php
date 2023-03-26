<?php

namespace App\Repositories;

use App\Models\Flight;

class FlightRepository extends Repository
{
    protected string $modelClass = Flight::class;

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getOneByUuid(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }
}
