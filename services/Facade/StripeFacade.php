<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class StripeFacade
 * @package services\Facades
 */
class StripeFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Stripe\StripeService';
    }
}
