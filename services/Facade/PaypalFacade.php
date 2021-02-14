<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class PaypalFacade
 * @package services\Facades
 */
class PaypalFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Paypal\PaypalService';
    }
}
