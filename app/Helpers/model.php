<?php 

function trans_model_key($model, $id = null)
{
    $key = 'models/' . str_replace('\\', '/', $model);

    if ( ! is_null($id))
    {
        $key .= '.' . $id;
    }

    return $key;
}

/**
 * Translate the given model message.
 *
 * @param  string  $model
 * @param  string  $id
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return \Symfony\Component\Translation\TranslatorInterface|string
 */
function trans_model($model, $id = null, $parameters = [], $domain = 'messages', $locale = null)
{
    return trans(trans_model_key($model, $id), $parameters, $domain, $locale);
}

/**
 * Translate the given model message based on a count.
 *
 * @param  string  $model
 * @param  string  $id
 * @param  int     $number
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return string
 */
function trans_model_choice($model, $id, $number, array $parameters = [], $domain = 'messages', $locale = null)
{
    return trans_choice(trans_model_key($model, $id), $number, $parameters, $domain, $locale);
}

/**
 * Return an array with specific key and value from given collection.
 * @param  \Illuminate\Database\Eloquent\Collection $collection
 * @param  string                                   $valueAttribute
 * @param  string                                   $keyAttribute
 * @param  boolean                                  $nullable
 * @return array
 */
function model_pairs(\Illuminate\Database\Eloquent\Collection $collection, $valueAttribute = 'id', $keyAttribute = 'id', $nullable = true)
{
    $data = ($nullable) ? ['' => '&nbsp;'] : [];

    foreach ($collection as $item)
    {
        $data[$item->{$keyAttribute}] = $item->{$valueAttribute};
    }

    return $data;
}