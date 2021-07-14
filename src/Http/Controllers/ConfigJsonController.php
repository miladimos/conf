<?php


namespace Miladimos\Conf\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        return ConfigJsonService::store($request->only('key', 'value'));
    }

    public function update(Request $request, $id)
    {
        return ConfigJsonService::update($request->only('key', 'value'), $id);
    }

    public function delete($id)
    {
        return ConfigJsonService::delete($id);
    }
}
