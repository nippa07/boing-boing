<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class QuoteRequestArtworkFacade
 * @package services\Facades
 */
class QuoteRequestArtworkFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\QuoteRequestArtwork\QuoteRequestArtworkService';
    }
}
