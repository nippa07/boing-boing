<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class AfterpayFacade
 * @package services\Facades
 */
class AfterpayFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Afterpay\AfterpayService';
    }
}
