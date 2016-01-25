<?php

namespace Serenity\Http\Controllers\Admin;

use GUI;
use Serenity\Region;
use Illuminate\Http\Request;
use Serenity\Http\Controllers\CRUDTrait;
use Vitlabs\GUIAdmin\Contracts\Elements\TableContract;
use Vitlabs\GUIAdmin\Contracts\Elements\BoxContract;
use Vitlabs\GUIAdmin\Contracts\Elements\ButtonGroupContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;
use Vitlabs\GUIAdmin\Contracts\FormElements\SubmitContract;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

class RegionsController extends Controller
{
    use CRUDTrait;

    protected $basicRoute = 'admin.regions';
    protected $model = '\Serenity\Region';

    protected function getEntitySingularName()
    {
        return "Region";
    }

    protected function getEntityPluralName()
    {
        return "Regions";
    }

    protected function getTableColumns()
    {
        return [ 'Name' ];
    }

    protected function getTableRowData($region)
    {
        return [
            $region->name
            //'<a href="' . $this->route('edit', $region->getKey()) . '">' . $region->name . '</a>'
        ];
    }

    protected function generateSubRows(TableContract $table, $region)
    {
        foreach ($region->districts as $district)
        {
            $table->addRow([
                $district->name,
                ''
            ])
            ->level(1)
            ->id($district->getKey())
            ->sortgroup('region_' . $region->getKey() . '_districts')
            ->model('\Serenity\District');
        }
    }

    protected function generateUniversalForm(FormContract $form, $id = null)
    {
        $model = Region::findOrNew($id);

        GUI::input()
            ->label("Name")
            ->name('name')
            ->value(is_null($model->name) ? '' : $model->name)
            ->to($form);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $object = new Region;
        $object->fill($request->all());
        $object->save();

        return $this->redirect('index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $object = Region::findOrFail($id);
            $object->fill($request->all());
            $object->save();

            return $this->redirect('index');
        }
        catch (\Exception $e)
        {
            return back()->withErrors("ID neexistuje");
        }
    }

}
