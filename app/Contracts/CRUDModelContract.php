<?php 

namespace Serenity\Contracts;

use Illuminate\Http\Request;

interface CRUDModelContract
{
    /**
     * Get translated model singular name;
     * @return string
     */
    static function getSingularName();

    /**
     * Get translated model plural name;
     * @return string
     */
    static function getPluralName();

    /**
     * Get array of fields available for "create" operation.
     * @return array
     */
    static function getCreateFields();

    /**
     * Get array of validation rules for "create" operation.
     * @return array
     */
    static function getCreateRules();
    
    /**
     * Get array of fields available for "update" operation.
     * @return array
     */
    static function getUpdateFields();

    /**
     * Get array of validation rules for "update" operation.
     * @return array
     */
    static function getUpdateRules();

    /**
     * Fill model attributes with values in request for "create" operation.
     * 
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    function fillForCreate(Request $request);

    /**
     * Fill model attributes with values in request for "update" operation.
     * 
     * @param  Illuminate\Http\Request $request
     * @return void
     */
    function fillForUpdate(Request $request);
}