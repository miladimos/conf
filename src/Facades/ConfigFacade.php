<?php

namespace Miladimos\Conf\Facades;

use Illuminate\Support\Facades\Facade;

class ConfFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'conf';
    }
}
