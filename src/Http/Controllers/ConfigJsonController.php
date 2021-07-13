<?php


namespace Miladimos\Conf\Http\Controller;

use Miladimos\Conf\Http\Controllers\Controller;
use Miladimos\Conf\Services\ConfigJsonService;

class ConfigJsonController extends Controller
{
    public function all()
    {
        return ConfigJsonService::all();
    }

    public function show($id)
    {
        return ConfigJsonService::show($id);
    }
}
