<?php

namespace App\Http\Controllers\Api;

use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class SystemConfigController extends Controller
{
    public function fetchConfig(Request $request, SystemConfigRepository $configRepository)
    {
        $configs = (array) $request->get('configs');

        $results = $configRepository->fetchConfigs($configs);

        $data = [];
        foreach ($results as $result) {
            if ($result->multiple) {
                $data[$result->name] ??= [];
                $data[$result->name][] = $result->value;
            } else {
                $data[$result->name] = $result->value;
            }
        }

        foreach ($configs as $config) {
            $data[$config] ??= null;
        }

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @param SystemConfigRepository $configRepository
     * @return \Illuminate\Http\Response
     */
    public function updateConfig(Request $request, SystemConfigRepository $configRepository)
    {
        $configs = $request->get('configs');

        foreach ($configs as $name => $value) {
            $model = $configRepository->getOne($name);
            $model->value = $value;
            $configRepository->persist($model);
        }

        return response()->noContent();
    }
}
