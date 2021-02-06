<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class QuoteFacade
 * @package services\Facades
 */
class QuoteFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Quote\QuoteService';
    }
}
