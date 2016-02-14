<?php

namespace Serenity\Http\Controllers\Architect;

use GUI;
use Request;
use Serenity\ContentType;
use Illuminate\Database\Eloquent\Model;
use Serenity\CRUD\Traits\CRUDControllerTrait;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class ContentTypesController extends Controller
{
    use CRUDControllerTrait;

    protected $basicRoute = 'admin.architect.content-types';
    protected $model = ContentType::class;

    protected function getTableRowData($contentType)
    {
        // TODO: "Áno" a "Nie" by mali byť preložené + je tu veľké zviazanie na HTML (span.badge ...) -> spraviť BadgeElement a LabelElement
        $true = GUI::tag('span', 'Áno')->addClass('badge bg-green');
        $false = GUI::tag('span', 'Nie')->addClass('badge bg-red');

        return [
            $this->link($contentType->name, 'edit', $contentType->id),
            $contentType->pageable ? $true : $false,
            $contentType->panelable ? $true : $false,
            $contentType->listable ? $true : $false,
        ];
    }

    protected function generateUniversalForm(FormContract $form, Model $model = null)
    {
        GUI::input()
            ->label("Name")
            ->name('name')
            ->value(val('name', $model))
            ->to($form);

        GUI::checkbox()
            ->label("Pageable")
            ->name('pageable')
            ->value(val('pageable', $model))
            ->to($form);

        GUI::checkbox()
            ->label("Panelable")
            ->name('panelable')
            ->value(val('panelable', $model))
            ->to($form);

        GUI::checkbox()
            ->label("Listable")
            ->name('listable')
            ->value(val('listable', $model))
            ->to($form);

        GUI::select()
            ->label("Page template")
            ->name('page_template')
            ->value(val('page_template', $model))
            ->options([]) // TODO
            ->to($form);

        GUI::select()
            ->label("Panel template")
            ->name('panel_template')
            ->value(val('panel_template', $model))
            ->options([]) // TODO
            ->to($form);

        GUI::select()
            ->label("Page class")
            ->name('page_class')
            ->value(val('page_class', $model))
            ->options([]) // TODO
            ->to($form);

        GUI::select()
            ->label("Panel class")
            ->name('panel_class')
            ->value(val('panel_class', $model))
            ->options([]) // TODO
            ->to($form);
    }

}
