<?php

namespace Serenity\Http\Controllers\Architect;

use Illuminate\Http\Request;

use Serenity\Http\Requests;
use Serenity\Http\Controllers\CRUDTrait;

class ContentTypesController extends Controller
{
    //use CRUDTrait;

    protected $titlePlural = 'Typy obsahu';
    protected $titleSingular = 'Typ obsahu';
    protected $model = '\Serenity\Admin';
    protected $basicRoute = 'admin.architect.content-types';

}
