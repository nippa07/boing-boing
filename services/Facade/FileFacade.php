<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class FileFacade
 * @package services\Facades
 */
class FileFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\File\FileService';
    }
}
