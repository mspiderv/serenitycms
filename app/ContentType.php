<?php

namespace Serenity;

use DB;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Builder;
use Serenity\CRUD\Contracts\CRUDModelContract;
use Serenity\CRUD\Traits\CRUDModelTrait;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class ContentType extends AbstractModel implements CRUDModelContract, OrderableModelContract
{
    use CRUDModelTrait, OrderableModelTrait;

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
        'page_template' => 'max:255|required_with:pageable',
        'panel_template' => 'max:255|required_with:panelable',
        'page_class' => 'max:255|required_with:pageable',
        'panel_class' => 'max:255|required_with:panelable',
    ];

    /**
     * Get the variables for the content type.
     */
    public function variables()
    {
        return $this->hasMany('Serenity\ContentTypeVariable');
    }
    
    /**
     * Register model event handlers.
     *
     * @return void
     */
    protected static function registerEventHandlers()
    {
        // Register created event handler for create content type data table.
        ContentType::created(function ($contentType)
        {
            Schema::create(ContentType::DATA_TABLE_PREFIX . $contentType->getKey(), function(Blueprint $table) use ($contentType)
            {
                $table->integer('id')->unsigned();
                
                $table->primary('id');

                $table->foreign('id')
                    ->references($contentType->getKeyName())
                    ->on($contentType->getTable())
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        });

        // Register deleting event handler for delete content type data table.
        ContentType::deleting(function($contentType)
        {
            Schema::drop(ContentType::DATA_TABLE_PREFIX . $contentType->getKey());
        });
    }
}