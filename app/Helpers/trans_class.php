<?php 

function trans_class_key($class, $id = null)
{
    $key = 'class/' . str_replace('\\', '/', $class);

    if ( ! is_null($id))
    {
        $key .= '.' . $id;
    }

    return $key;
}

/**
 * Translate the given class message.
 *
 * @param  string  $class
 * @param  string  $id
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return \Symfony\Component\Translation\TranslatorInterface|string
 */
function trans_class($class, $id = null, $parameters = [], $domain = 'messages', $locale = null)
{
    return trans(trans_class_key($class, $id), $parameters, $domain, $locale);
}

/**
 * Translate the given class message based on a count.
 *
 * @param  string  $class
 * @param  string  $id
 * @param  int     $number
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return string
 */
function trans_class_choice($class, $id, $number, array $parameters = [], $domain = 'messages', $locale = null)
{
    return trans_choice(trans_class_key($class, $id), $number, $parameters, $domain, $locale);
}