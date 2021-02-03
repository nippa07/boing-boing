<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class UserFacade
 * @package services\Facades
 */
class UserFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\User\UserService';
    }
}
