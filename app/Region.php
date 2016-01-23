<?php

namespace Serenity;

use Illuminate\Database\Eloquent\Model;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class Region extends Model implements OrderableModelContract
{
    use OrderableModelTrait;

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'regions';

    /**
     * Get the districts for the region.
     */
    public function districts()
    {
        return $this->hasMany('Serenity\District');
    }

}
