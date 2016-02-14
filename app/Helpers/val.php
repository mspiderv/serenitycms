<?php

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * Return current value for the form fields based on the given request and model.
 *
 * @param  string       $key
 * @param  Model|null   $model
 * @param  Request|null $request
 * @return mixed
 */
function val($key, Model $model = null, $default = null, Request $request = null)
{
    // Initialize value
    $value = null;

    // Get request
    if (is_null($request))
    {
        $request = app('request');
    }

    // Get session
    $session = $request->session();

    // Do we have value in current input ?
    if ($request->has($key))
    {
        $value = $request->input($key);
    }

    // Do we have value in old input ?
    else if ($session->hasOldInput($key))
    {
        $value = $session->getOldInput($key);
    }

	// Do we have value in model ?
    else if ( ! is_null($model))
    {
        $value = $model->getAttribute($key);
    }

	// We use default value
	else
	{
		$value = $default;
	}

    // Result value should not be null
    if (is_null($value))
    {
        $value = '';
    }

    // We are done
    return $value;
}
