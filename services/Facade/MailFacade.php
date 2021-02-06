<?php

namespace services\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class MailFacade
 * @package services\Facades
 */
class MailFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'services\Mail\MailService';
    }
}
