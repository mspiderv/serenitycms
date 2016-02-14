<?php 

// TODO: prerobit aby to bralo lubovolny pocet parametrov pre funckiu "route" nie len jeden (id)
function a($text, $routeOrURL, $id = null)
{
    $element = GUI::tag('a', $text);
    $element->attr('href', Route::has($routeOrURL) ? route($routeOrURL, $id) : $routeOrURL);
    return $element;
}

// TODO: prerobit aby to bralo lubovolny pocet parametrov pre funckiu "route" nie len jeden (id)
function a_table($text, $routeOrURL, $id = null)
{
    $element = a($text, $routeOrURL, $id);
    $element->addClass('table-link');
    return $element;
}