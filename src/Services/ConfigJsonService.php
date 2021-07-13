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
            if ($conf['id'] == $id) return $conf;
        }
        return false;
    }

    public static function store($data)
    {
        $path = config('conf.path');

        $configs = self::all();

        foreach ($configs as $key) {
            if($key['key'] == $data['key']) return false;
        }

        $config['id']    = random_int(1000, 9000);
        $config['key']   = $data['key'];
        $config['value'] = $data['value'];

//        array_push($configs, $config);
        $configs[] = $config;

        file_put_contents($path, json_encode($configs));

        return true;
    }

    public static function update($date, $id)
    {
        $path = config('conf.path');

        $configs = self::all();

        foreach ($configs as $i => $config) {
            if ($config['id'] == $id) {
                $configs[$i] = array_merge($config, $date);
            }
        }
        file_put_contents($path, json_encode($configs));
        return true;
    }


    public static function delete($id)
    {

        $path = config('conf.path');

        $configs = self::all();

        foreach ($configs as $i => $config) {
            if ($config['id'] == $id) {
//                unset($configs[$i]);
                array_splice($configs, $i, 1);
            }
        }

        file_put_contents($path, json_encode($configs));

        return true;
    }
}
