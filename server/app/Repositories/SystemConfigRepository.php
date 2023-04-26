<?php

namespace App\Repositories;

use App\Models\SystemConfig;

class SystemConfigRepository extends Repository
{
    protected string $modelClass = SystemConfig::class;

    /**
     * @param string $name
     * @return SystemConfig|mixed
     */
    public function getOne(string $name)
    {
        return SystemConfig::query()
            ->where('name', $name)
            ->firstOrNew([
                'name' => $name
            ]);
    }

    /**
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMultiple(string $name)
    {
        return SystemConfig::query()
            ->where('name', $name)
            ->get();
    }

    /**
     * @param array $configs
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetchConfigs(array $configs)
    {
        return SystemConfig::query()
            ->whereIn('name', $configs)
            ->get();
    }
}
