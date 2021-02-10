<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class OrderFacade
 * @package services\Facades
 */
class OrderFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Order\OrderService';
    }
}
