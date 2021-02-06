<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class QuoteItemFacade
 * @package services\Facades
 */
class QuoteItemFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\QuoteItem\QuoteItemService';
    }
}
