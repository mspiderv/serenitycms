<?php

namespace Serenity;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        // Boot model
        parent::boot();

        // Register event handlers
        static::registerEventHandlers();
    }

    /**
     * Register model event handlers.
     *
     * @return void
     */
    protected static function registerEventHandlers()
    {
        //
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
        return DB::transaction(function() use ($query, $options)
        {
            return parent::performInsert($query, $options);
        });
    }
}