<?php

namespace Serenity\Http\Controllers\Admin;

use Vitlabs\GUICore\Facades\Generator as GUI;

use Serenity\Region;
use Illuminate\Database\Eloquent\Model;
use Serenity\Traits\CRUDControllerTrait;
use Vitlabs\GUIAdmin\Contracts\Elements\TableContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class RegionsController extends Controller
{
    use CRUDControllerTrait;

    protected $basicRoute = 'admin.regions';
    protected $model = '\Serenity\Region';

    protected function getTableRowData($region)
    {
        return [
            $this->link($region->name, 'edit', $region->id)
        ];
    }

    protected function generateSubRows(TableContract $table, $region)
    {
        foreach ($region->districts as $district)
        {
            $table->addRow([
                '<a href="' . route('admin.districts.show', $district->id) . '">' . $district->name . '</a>',
                ''
            ])
            ->level(1)
            ->id($district->getKey())
            ->sortgroup('region_' . $region->getKey() . '_districts')
            ->model('\Serenity\District');
        }
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
