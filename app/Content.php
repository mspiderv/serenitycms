<?php

namespace Serenity;

use Serenity\CRUD\Contracts\CRUDModelContract;
use Serenity\CRUD\Traits\CRUDModelTrait;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class Content extends AbstractModel implements CRUDModelContract, OrderableModelContract
{
    use CRUDModelTrait, OrderableModelTrait;

    /**
     * Validation rules for create and update operations
     *
     * @var array
     */
    public static $rules = [
    ];
}
