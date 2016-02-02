<?php

namespace Serenity\Http\Controllers\Admin;

use Vitlabs\GUICore\Facades\Generator as GUI;

use Serenity\Region;
use Illuminate\Database\Eloquent\Model;
use Serenity\Traits\CRUDControllerTrait;
use Vitlabs\GUIAdmin\Contracts\Elements\TableContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class DistrictsController extends Controller
{
    use CRUDControllerTrait;

    protected $basicRoute = 'admin.districts';
    protected $model = '\Serenity\District';

    protected function getTableRowData($district)
    {
        return [
            $this->link($district->name, 'edit', $district->id)
        ];
    }

    protected function generateUniversalForm(FormContract $form, Model $model = null)
    {
        GUI::input()
            ->label("Name")
            ->name('name')
            ->value(is_null($model) ? '' : $model->name)
            ->to($form);
    }

    protected function generateShowView(ContainerElement $container, Model $model)
    {
        $container->add(GUI::tag('p', "<strong>Name:</strong> {$model->name}"));
    }

}
