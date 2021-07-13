<?php


namespace Miladimos\Conf\Services;

use Illuminate\Http\Request;

class ConfigJsonService
{
    public static function all()
    {
        $path = config('conf.path');

        return json_decode(file_get_contents($path), true);
    }

    public static function show($id)
    {
        $configs = self::all();
        foreach ($configs as $conf) {
            if($conf['id'] == $id) return $conf;
        }
        return false;
    }

    public static function store($data)
    {
        $path = config('conf.path');

        $data = file_get_contents($path);
        $data = json_decode($data, true);

        $add_arr = [
            'ADMIN_TITLE' => "VALUE",
        ];

        $data[] = $add_arr;

        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($data, $data);

        return true;
    }

    public static function update($date, $id)
    {
        $path = config('conf.path');

        $configs = self::all();

        foreach($configs as $i => $config) {
            if($config['id'] == $id) {
                $configs[$i] = array_merge($config, $date);
            }
        }
        file_put_contents($path, json_encode($configs));
    }

    public static function delete($id)
    {

        $path = config('conf.path');

        $data = file_get_contents($path);
        $data = json_decode($data, true);

        unset($data[$id]);

        //encode back to json
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $data);

        return response()->json($data);
    }
}
