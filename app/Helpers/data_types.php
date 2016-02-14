<?php 

function get_data_types()
{
    return [

        'number' => [
            'integer',
            'smallInteger',
            'bigInteger',
            'float',
            'decimal',
            'boolean',
        ],

        'text' => [
            'string',
            'text',
            'mediumText',
            'longText',
        ],

        'time' => [
            'date',
            'dateTime',
            'time',
        ],

    ];
}

function get_named_data_types()
{
    $data = get_data_types();
    static $namedDataTypes = null;

    if (is_null($namedDataTypes))
    {
        foreach ($data as $category => $dataTypes)
        {
            $categoryData = [];

            foreach ($dataTypes as $dataType)
            {
                $categoryData[$dataType] = trans('data_types.' . $dataType);
            }

            $namedDataTypes[trans('data_types.category.' . $category)] = $categoryData;
        }
    }

    return $namedDataTypes;
}