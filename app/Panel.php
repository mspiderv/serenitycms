<?php

namespace Serenity;

use Illuminate\Database\Eloquent\Model;
use Serenity\Contracts\CRUDModelContract;
use Serenity\Traits\CRUDModelTrait;

class Panel extends Model implements CRUDModelContract
{
    use CRUDModelTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Validation rules for create and update operations
     *
     * @var array
     */
    public static $rules = [
    ];
}
