<?php

namespace Serenity;

use Illuminate\Database\Eloquent\Model;
use Serenity\Contracts\CRUDModelContract;
use Serenity\Traits\CRUDModelTrait;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class ContentTypeVariable extends Model implements CRUDModelContract
{
    use CRUDModelTrait, OrderableModelTrait;

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
        'variable' => 'required|max:255',
        'content_type_id' => 'required|exists:content_types,id',
    ];

    /**
     * Get the content type that owns the content type variable.
     */
    public function contentType()
    {
        return $this->belongsTo('Serenity\ContentType');
    }
}
