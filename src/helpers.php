<?php

if(!function_exists('conf'))
{
    function conf($key)
    {
        $configs = \Miladimos\Conf\Services\ConfigJsonService::all();
        foreach ($configs as $config)
        {
            if($config['key'] == $key) return $config['value'];
        }

        return false;
    }
}
