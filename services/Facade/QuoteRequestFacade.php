<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class QuoteRequestFacade
 * @package services\Facades
 */
class QuoteRequestFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\QuoteRequest\QuoteRequestService';
    }
}
