<?php

namespace Serenity;

use Illuminate\Database\Eloquent\Model;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class District extends Model implements OrderableModelContract
{
    use OrderableModelTrait;

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

    /**
     * Get the region that consists the district.
     */
    public function region()
    {
        return $this->belongsTo('Serenity\Region');
    }

}
