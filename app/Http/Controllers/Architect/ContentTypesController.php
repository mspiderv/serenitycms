<?php

namespace Serenity\Http\Controllers\Architect;

use GUI;
use Request;
use Serenity\ContentType;
use Illuminate\Database\Eloquent\Model;
use Serenity\Traits\CRUDControllerTrait;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class ContentTypesController extends Controller
{
    use CRUDControllerTrait;

    protected $basicRoute = 'admin.architect.content-types';
    protected $model = ContentType::class;

    protected function getTableRowData($contentType)
    {
        return [
            $this->link($contentType->name, 'edit', $contentType->id)
        ];
    }

    protected function generateUniversalForm(FormContract $form, Model $model = null)
    {
        GUI::input()
            ->label("Name")
            ->name('name')
            ->value(Request::old('name') ?: (is_null($model) ? '' : $model->name) ?: '')
            ->to($form);

        GUI::checkbox()
            ->label("Pageable")
            ->name('pageable')
            ->value(Request::old('pageable') ?: (is_null($model) ? '' : $model->pageable) ?: '')
            ->to($form);

        GUI::checkbox()
            ->label("Panelable")
            ->name('panelable')
            ->value(Request::old('panelable') ?: (is_null($model) ? '' : $model->panelable) ?: '')
            ->to($form);

        /* TODO
         *     page_template
         *     panel_template
         *     page_class
         *     panel_class
         */
    }

}
