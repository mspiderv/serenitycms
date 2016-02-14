<?php

namespace Serenity;

use Serenity\CRUD\Contracts\CRUDModelContract;
use Serenity\CRUD\Traits\CRUDModelTrait;

class Page extends AbstractModel implements CRUDModelContract
{
    use CRUDModelTrait;

    /**
     * Validation rules for create and update operations
     *
     * @var array
     */
    public static $rules = [
    ];
}
