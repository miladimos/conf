<?php

namespace Miladimos\Conf\Services;

class ConfigJsonService
{
    /**
     * get all configs
     * @return array
     */
    public static function all(): array
    {
        $path = config('conf.path');
        return json_decode(file_get_contents($path), true);
    }

    /**
     * get a config with id
     * @param int $id
     * @return bool|string
     */
    public static function show(int $id)
    {
        $configs = self::all();
        foreach ($configs as $key => $value) {
            if ($value['id'] == $id) {
                return $value;
            }
        }
        return false;
    }

    /**
     * store a new config
     * @param array $data
     * @return bool
     */
    public static function store(array $data):bool
    {
        $path = config('conf.path');
        $configs = self::all();
        foreach ($configs as $key => $value) {
            if($key == $data['key']) {
                return false;
            }
        }
        try {
            $config['id'] = random_int(1000, 9000);
            $config['key']   = $data['key'];
            $config['value'] = $data['value'];
            $configs[$data['key']] = $config;
            file_put_contents($path, json_encode($configs));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * update a config with id
     * @param array $data
     * @param int $id
     * @return bool
     */
    public static function update(array $data, int $id) :bool
    {
        $path = config('conf.path');
        $configs = self::all();
        foreach ($configs as $i => $config) {
            if ($config['id'] == $id) {
                $configs[$data['key']] = $data;
                file_put_contents($path, json_encode($configs));
                return true;
            }
        }
        return false;
    }

    /**
     * delete a config
     * @param int $id
     * @return bool
     */
    public static function delete(int $id) :bool
    {
        $path = config('conf.path');
        $configs = self::all();
        foreach ($configs as $i => $config) {
            if ($config['id'] == $id) {
                unset($configs[$i]);
                $a = empty($configs) ? "{}" : json_encode($configs);
                file_put_contents($path, $a);
                return true;
            }
        }
        return false;
    }
}
