<?php

namespace Serenity;

use DB;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Serenity\Contracts\CRUDModelContract;
use Serenity\Traits\CRUDModelTrait;

class ContentType extends Model implements CRUDModelContract
{
    use CRUDModelTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Prefix of the content type data tables.
     * 
     * @var string
     */
    const DATA_TABLE_PREFIX = 'content_type_data_';

    /**
     * Validation rules for create and update operations
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255',
        'pageable' => 'boolean',
        'panelable' => 'boolean',
        'page_template' => 'max:255',
        'panel_template' => 'max:255',
        'page_class' => 'max:255',
        'panel_class' => 'max:255',
    ];

    /**
     * Get the variables for the content type.
     */
    public function variables()
    {
        return $this->hasMany('Serenity\ContentTypeVariable');
    }

    protected function setPageableAttribute($value)
    {
        $this->attributes['pageable'] = (bool) $value;
    }

    protected function setPanelableAttribute($value)
    {
        $this->attributes['panelable'] = (bool) $value;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        /**
         * Boot model.
         */
        parent::boot();

        /**
         * Register created event handler for create content type data table.
         */
        ContentType::created(function ($contentType)
        {
            Schema::create(ContentType::DATA_TABLE_PREFIX . $contentType->getKey(), function (Blueprint $table) use ($contentType)
            {
                $table->integer('id')->unsigned();

                $table->foreign('id')
                    ->references($contentType->getKeyName())
                    ->on($contentType->getTable())
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        });

        /**
         * Register deleting event handler for delete content type data table.
         */
        ContentType::deleting(function ($contentType)
        {
            Schema::drop(ContentType::DATA_TABLE_PREFIX . $contentType->getKey());
        });
    }

    /**
     * Perform a model insert operation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $options
     * @return bool
     */
    protected function performInsert(Builder $query, array $options = [])
    {
        DB::transaction(function() use ($query, $options)
        {
            parent::performInsert($query, $options);
        });
    }
}