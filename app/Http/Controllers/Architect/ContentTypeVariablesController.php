<?php

namespace Serenity\Http\Controllers\Architect;

use GUI;
use Request;
use Serenity\ContentType;
use Serenity\ContentTypeVariable;
use Illuminate\Database\Eloquent\Model;
use Serenity\Traits\CRUDControllerTrait;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class ContentTypeVariablesController extends Controller
{
    use CRUDControllerTrait;

    protected $basicRoute = 'admin.architect.content-type-variables';
    protected $model = ContentTypeVariable::class;

    protected function getTableRowData($contentTypeVariable)
    {
        return [
            $this->link($contentTypeVariable->variable, 'edit', $contentTypeVariable->id),
            GUI::tag('a', $contentTypeVariable->contentType->name)
                ->attr('href', route('admin.architect.content-types.edit', $contentTypeVariable->contentType->id))
        ];
    }

    protected function generateUniversalForm(FormContract $form, Model $model = null)
    {
        GUI::input()
            ->label("Variable name")
            ->name('variable')
            ->value(Request::old('variable') ?: (is_null($model) ? '' : $model->variable) ?: '')
            ->to($form);

        GUI::select()
            ->label("Content type")
            ->name('content_type_id')
            ->options(model_pairs(ContentType::all(), 'name'))
            ->value(Request::old('content_type_id') ?: (is_null($model) ? '' : $model->content_type_id) ?: '')
            ->to($form);
    }

}
