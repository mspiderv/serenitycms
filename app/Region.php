<?php

namespace Serenity;

use Illuminate\Database\Eloquent\Model;
use Serenity\Contracts\CRUDModelContract;
use Serenity\Traits\CRUDModelTrait;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class Region extends Model implements OrderableModelContract, CRUDModelContract
{
    use CRUDModelTrait, OrderableModelTrait;

    /**
     * Validation rules for create and update operations
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    /**
     * Get the districts for the region.
     */
    public function districts()
    {
        return $this->hasMany('Serenity\District');
    }

}
