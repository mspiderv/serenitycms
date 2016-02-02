<?php

namespace Serenity;

use Illuminate\Database\Eloquent\Model;
use Serenity\Contracts\CRUDModelContract;
use Serenity\Traits\CRUDModelTrait;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class District extends Model implements OrderableModelContract, CRUDModelContract
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
     * Get the region that consists the district.
     */
    public function region()
    {
        return $this->belongsTo('Serenity\Region');
    }

}
