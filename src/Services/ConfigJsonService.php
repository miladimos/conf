<?php


namespace Miladimos\Conf\Services;


use Illuminate\Http\Request;

class ConfigJsonService
{

//    public function __construct()
//    {
//        $path = config('conf.path');
//    }

    public static function all()
    {
        $path = config('conf.path');

        $data = file_get_contents($path);

        $data = json_decode($data);

        return response()->json($data);
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

    public static function edit()
    {
        $path = config('conf.path');

        $data = file_get_contents($path);
        $data_array = json_decode($data, true);
        $row = $data_array[$id];


        $update_arr = array(
            'id' => $_POST['id'],
            'first_name' => $_POST['txtFname'],
            'last_name' => $_POST['txtLname'],
        );

        $data_array[$edit_id] = $update_arr;

        $data = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents('users.json', $data);
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
