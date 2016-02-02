<?php

namespace Serenity\Traits;

use Illuminate\Http\Request;

trait CRUDModelTrait
{
    /**
     * Get translated model singular name;
     * @return string
     */
    public static function getSingularName()
    {
        return trans_model(__CLASS__, 'name.singular');
    }

    /**
     * Get translated model plural name;
     * @return string
     */
    public static function getPluralName()
    {
        return trans_model(__CLASS__, 'name.plural');
    }

    /**
     * Get array of fields available for "create" operation.
     * @return array
     */
    public static function getCreateFields()
    {
        if (isset(static::$fields_create))
        {
            return static::$fields_create;
        }
        else
        {
            return array_keys(static::getCreateRules());
        }
    }

    /**
     * Get array of validation rules for "create" operation.
     * @return array
     */
    public static function getCreateRules()
    {
        if (isset(static::$rules_create))
        {
            return static::$rules_create;
        }
        else if (isset(static::$rules))
        {
            return static::$rules;
        }
        else
        {
            return [];
        }
    }
    
    /**
     * Get array of fields available for "update" operation.
     * @return array
     */
    public static function getUpdateFields()
    {
        if (isset(static::$fields_update))
        {
            return static::$fields_update;
        }
        else
        {
            return array_keys(static::getUpdateRules());
        }
    }

    /**
     * Get array of validation rules for "update" operation.
     * @return array
     */
    public static function getUpdateRules()
    {
        if (isset(static::$rules_update))
        {
            return static::$rules_update;
        }
        else if (isset(static::$rules))
        {
            return static::$rules;
        }
        else
        {
            return [];
        }
    }
    
    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
        return array_unique(array_merge($this->getCreateFields(), $this->getUpdateFields()));
    }

    /**
     * Fill model attributes with values in request for "create" operation.
     * 
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function fillForCreate(Request $request)
    {
        $this->fillForOperation($request, static::getCreateFields(), static::getCreateRules());
    }

    /**
     * Fill model attributes with values in request for "update" operation.
     * 
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    public function fillForUpdate(Request $request)
    {
        $this->fillForOperation($request, static::getUpdateFields(), static::getUpdateRules());
    }

    /**
     * Fill model attributes with values in request with given fields and rules.
     * 
     * @param  Illuminate\Http\Request $request
     * @param  array                   $fields
     * @param  array                   $rules
     * @return void
     */
    protected function fillForOperation(Request $request, array $fields, array $rules)
    {
        foreach ($fields as $field)
        {
            $value = $request->input($field);

            if (is_null($value) && in_array('boolean', explode('|', $rules[$field])))
            {
                $value = false;
            }

            $this->setAttribute($field, $value);
        }
    }

}