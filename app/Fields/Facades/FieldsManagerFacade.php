<?php

namespace Serenity\Fields\Facades;

use Illuminate\Support\Facades\Facade;
use Serenity\Fields\Contracts\FieldsManagerContract;

class FieldsManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FieldsManagerContract::class;
    }
}
