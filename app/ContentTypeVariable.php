<?php

namespace Serenity;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use Serenity\ContentType;
use Serenity\CRUD\Contracts\CRUDModelContract;
use Serenity\CRUD\Traits\CRUDModelTrait;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\OrderableModel\Traits\OrderableModelTrait;

class ContentTypeVariable extends AbstractModel implements CRUDModelContract, OrderableModelContract
{
    use CRUDModelTrait, OrderableModelTrait;

    /**
     * Validation rules for create and update operations
     *
     * @var array
     */
    public static $rules = [
        'variable' => 'required|max:255',
        'content_type_id' => 'required|exists:content_types,id',
        'data_type' => 'required|max:255',
        'nullable' => 'boolean',
        'unsigned' => 'boolean',
    ];

    /**
     * Register model event handlers.
     *
     * @return void
     */
    protected static function registerEventHandlers()
    {
        // Register created event handler for create content type variable column.
        ContentTypeVariable::created(function ($contentTypeVariable)
        {
            Schema::table(ContentType::DATA_TABLE_PREFIX . $contentTypeVariable->contentType->id, function(Blueprint $table) use ($contentTypeVariable)
            {
                // Create a new column
                $column = $table->{$contentTypeVariable->data_type}($contentTypeVariable->variable);

                // Should be new column nullable ?
                $column->nullable = $contentTypeVariable->nullable;

                // Should be new column unsigned ?
                $column->unsigned = $contentTypeVariable->unsigned;
            });
        });

        // Register updated event handler for update content type variable column.
        ContentTypeVariable::updated(function ($contentTypeVariable)
        {
            // Change column name
            if ($contentTypeVariable->getOriginal('variable') !== $contentTypeVariable->variable)
            {
                Schema::table(ContentType::DATA_TABLE_PREFIX . $contentTypeVariable->contentType->id, function(Blueprint $table) use ($contentTypeVariable)
                {
                    $table->renameColumn($contentTypeVariable->getOriginal('variable'), $contentTypeVariable->variable);
                });
            }

            // Change column data type, if something has changed
            if (
                $contentTypeVariable->getOriginal('data_type') !== $contentTypeVariable->data_type ||
                $contentTypeVariable->getOriginal('nullable') !== $contentTypeVariable->nullable ||
                $contentTypeVariable->getOriginal('unsigned') !== $contentTypeVariable->unsigned
            )
            {
                Schema::table(ContentType::DATA_TABLE_PREFIX . $contentTypeVariable->contentType->id, function(Blueprint $table) use ($contentTypeVariable)
                {
                    // Set column new data type
                    $column = $table->{$contentTypeVariable->data_type}($contentTypeVariable->variable);

                    // Should be new column nullable ?
                    $column->nullable = $contentTypeVariable->nullable;

                    // Should be new column unsigned ?
                    $column->unsigned = $contentTypeVariable->unsigned;

                    // Change column
                    $column->change();
                });
            }
        });

        // Register deleting event handler for delete content type variable column.
        ContentTypeVariable::deleting(function ($contentTypeVariable)
        {
            Schema::table(ContentType::DATA_TABLE_PREFIX . $contentTypeVariable->contentType->id, function(Blueprint $table) use ($contentTypeVariable)
            {
                // Drop the variable column
                $table->dropColumn($contentTypeVariable->variable);
            });
        });
    }

    /**
     * Get the content type that owns the content type variable.
     */
    public function contentType()
    {
        return $this->belongsTo('Serenity\ContentType');
    }
}
