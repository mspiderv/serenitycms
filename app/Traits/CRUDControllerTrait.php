<?php

namespace Serenity\Traits;

use Vitlabs\GUICore\Facades\Generator as GUI;
use Illuminate\Support\Facades\Route;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Lang;

use Serenity\Contracts\CRUDModelContract;
use Serenity\Exceptions\NotImplementedException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Vitlabs\OrderableModel\Contracts\OrderableModelContract;
use Vitlabs\GUIAdmin\Contracts\Elements\TableContract;
use Vitlabs\GUIAdmin\Contracts\Elements\BoxContract;
use Vitlabs\GUIAdmin\Contracts\Elements\ButtonGroupContract;
use Vitlabs\GUIAdmin\Contracts\Elements\ButtonContract;
use Vitlabs\GUIAdmin\Contracts\FormElements\SubmitContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

trait CRUDControllerTrait
{
    // Optional methods
    protected function customizeIndexBox(BoxContract $box) { }
    protected function customizeIndexButtonGroup(ButtonGroupContract $buttonGroup) { }
    protected function customizeCreateButtonGroup(ButtonGroupContract $buttonGroup) { }
    protected function customizeShowButtonGroup(ButtonGroupContract $buttonGroup) { }
    protected function customizeEditButtonGroup(ButtonGroupContract $buttonGroup) { }
    protected function customizeTable(TableContract $table) { }
    protected function customizeTableRow($row) { }
    protected function generateSubRows(TableContract $table, $parentRow) { }
    protected function customizeCreateButton(ButtonContract $button) { }
    protected function customizeBackButton(ButtonContract $button) { }
    protected function customizeEditButton(ButtonContract $button) { }
    protected function customizeCreateSubmit(SubmitContract $submit) { }
    protected function customizeEditSubmit(SubmitContract $submit) { }
    protected function generateUniversalForm(FormContract $form, Model $model = null) { }
    protected function generateShowView(ContainerElement $container, Model $model) { }

    protected function getTransFile()
    {
        if (property_exists(__CLASS__, 'transFile'))
        {
            return $this->transFile;
        }
        else
        {
            // Make "some_name" from "SomeNameController".
            $pieces = explode('\\', substr(__CLASS__, 0, -10));
            return snake_case(array_pop($pieces));
        }
    }

    protected function trans($key)
    {
        $customKey = 'crud/' . $this->getTransFile() . '.' . $key;
        $genericKey = 'crud/generic.' . $key;

        $params = [
            'sg' => lcfirst($this->getEntitySingularName()),
            'pl' => lcfirst($this->getEntityPluralName()),
        ];

        return trans(Lang::has($customKey) ? $customKey : $genericKey, $params);
    }

    protected function getTableColumns()
    {
        return $this->trans('column');
    }

    protected function getTableRowData($row)
    {
        return [
            $row->getKey()
        ];
    }

    protected function getTableRows()
    {
        return $this->modelCall('all');
    }

    protected function getBasicRoute()
    {
        return $this->basicRoute;
    }

    protected function getFullRouteName($route)
    {
        return $this->getBasicRoute() . '.' . $route;
    }

    protected function redirect()
    {
        $args = func_get_args();
        $args[0] = $this->getFullRouteName($args[0]);
        return call_user_func_array([ redirect(), 'route' ], $args);
    }

    protected function route()
    {
        $args = func_get_args();
        $args[0] = $this->getFullRouteName($args[0]);
        return call_user_func_array('route', $args);
    }

    protected function link($content, $operation, $id = null)
    {
        $allowedOperation = 'isAllowed' . ucfirst($operation);

        if (method_exists($this, $allowedOperation) && $this->$allowedOperation())
        {
            return GUI::tag('a', $content)
                ->attr('href', $this->route($operation, $id));
        }
        else
        {
            return GUI::tag('span', $content);
        }
    }

    protected function isAllowedIndex()
    {
        return Route::has($this->getBasicRoute() . '.index');
    }

    protected function isAllowedShow()
    {
        return Route::has($this->getBasicRoute() . '.show');
    }

    protected function isAllowedCreate()
    {
        return Route::has($this->getBasicRoute() . '.create');
    }

    protected function isAllowedEdit()
    {
        return Route::has($this->getBasicRoute() . '.edit');
    }

    protected function isAllowedDestroy()
    {
        return Route::has($this->getBasicRoute() . '.destroy');
    }

    protected function getRowID($row)
    {
        return $row->getKey();
    }

    protected function getRowOptions($row)
    {
        $options = '';

        // Add "Show" button
        if ($this->isAllowedShow())
            $options .= '<a href="' . $this->route('show', $row->getKey()) . '" class="table-link">' . $this->trans('button.show') . '</a>';

        // Add "Edit" button
        if ($this->isAllowedEdit())
            $options .= '<a href="' . $this->route('edit', $row->getKey()) . '" class="table-link">' . $this->trans('button.edit') . '</a>';

        // Add "Delete" button
        if ($this->isAllowedDestroy())
            $options .= '<a href="' . $this->route('destroy', $row->getKey()) . '" class="table-link">' . $this->trans('button.delete') . '</a>'; // TODO: dorobit confirmy

        return $options;
    }

    protected function getRowExtraOptions($row)
    {
        return '';
    }

    protected function getModel()
    {
        return $this->model;
    }

    protected function modelCall($method)
    {
        $args = func_get_args();
        $method = array_shift($args);

        return call_user_func_array([ $this->getModel(), $method ], $args);
    }

    protected function modelCallArray($method, array $args = [])
    {
        return call_user_func_array([ $this->getModel(), $method ], $args);
    }

    protected function getSortGroup()
    {
        return 'main_group';
    }

    protected function modelImplements($interface)
    {
        return in_array($interface, class_implements($this->getModel()));
    }

    protected function canSort()
    {
        return $this->modelImplements(OrderableModelContract::class);
    }

    protected function getEntitySingularName()
    {
        if ($this->modelImplements(CRUDModelContract::class))
        {
            return $this->modelCall('getSingularName');
        }
        else
        {
            return str_singular($this->getModel());
        }
    }

    protected function getEntityPluralName()
    {
        if ($this->modelImplements(CRUDModelContract::class))
        {
            return $this->modelCall('getPluralName');
        }
        else
        {
            return str_plural($this->getModel());
        }
    }

    // Title methods
    protected function getIndexTitle()
    {
        return $this->trans('title.index');
    }

    protected function getCreateTitle()
    {
        return $this->trans('title.create');
    }

    protected function getShowTitle()
    {
        return $this->trans('title.show');
    }

    protected function getEditTitle()
    {
        return $this->trans('title.edit');
    }

    protected function generateBackButton(ContainerElement $container)
    {
        if ($this->isAllowedIndex())
        {
            $button = GUI::button($this->trans('button.index'), 'default')
                ->attr('href', $this->route('index'))
                ->to($container);

            $this->customizeBackButton($button);
        }
    }

    protected function generateCreateForm(FormContract $form)
    {
        return $this->generateUniversalForm($form, null);
    }

    protected function generateEditForm(FormContract $form, Model $model)
    {
        return $this->generateUniversalForm($form, $model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Set title
        $this->title($this->getIndexTitle());

        // Buttons
        $buttonGroup = GUI::buttonGroup()
            ->appendAttribute('style', 'padding-bottom: 20px;') // TODO
            ->to($this->window);

        // Add "Create" button
        if ($this->isAllowedCreate())
        {
            $button = GUI::button($this->trans('button.create'), 'primary')
                ->attr('href', $this->route('create'))
                ->to($buttonGroup);

            $this->customizeCreateButton($button);
        }

        // Customize button group
        $this->customizeIndexButtonGroup($buttonGroup);

        // Box
        $box = GUI::box($this->getEntityPluralName())
            ->to($this->window);

        // Customize box
        $this->customizeIndexBox($box);

        // Table
        $columns = $this->getTableColumns();

        $table = GUI::table()
            ->to($box)
            ->addColumns($columns);

        // Customize table
        $this->customizeTable($table);

        // Add rows
        foreach ($this->getTableRows() as $row)
        {
            $rowData = $this->getTableRowData($row);
            $rowData[] = $this->getRowOptions($row) . $this->getRowExtraOptions($row);

            $rowElement = $table->addRow($rowData);

            if ($this->canSort())
            {
                $rowElement
                    ->id($this->getRowID($row))
                    ->sortgroup($this->getSortGroup())
                    ->model($this->getModel());
            }

            // Customize table row
            $this->customizeTableRow($row);

            // Generate subrows
            $this->generateSubRows($table, $row);
        }

        // Add buttons to page bottom
        $buttonGroup->to($this->window);

        // Render window
        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Set title
        $this->title($this->getCreateTitle());

        // Create form
        $form = GUI::form([ 'route' => $this->getFullRouteName('store') ])
            ->to($this->window);

        // Show fields
        $this->generateCreateForm($form);

        // Buttons
        $buttonGroup = GUI::buttonGroup()
            ->to($form);

        // Add "Submit" button
        $button = GUI::submit($this->trans('button.store'))
            ->to($buttonGroup);

        // Customize "Update" button
        $this->customizeCreateSubmit($button);

        // Add "Back" button
        $this->generateBackButton($buttonGroup);

        // Customize button group
        $this->customizeCreateButtonGroup($buttonGroup);

        // Render window
        return $this->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->modelImplements(CRUDModelContract::class))
        {
            // Validate request
            $this->validate($request, $this->modelCall('getCreateRules'));

            // Store new item
            $modelName = $this->getModel();
            $model = new $modelName;
            $model->fillForCreate($request);
            $model->save();

            // Flash success message
            Flash::success($this->trans('message.store'));

            // Redirect
            return $this->redirect('index');
        }
        else
        {
            throw new NotImplementedException('You need to implement [store] operation.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find model
        try
        {
            $model = $this->modelCall('findOrFail', $id);
        }
        catch (ModelNotFoundException $e)
        {
            Flash::error($this->trans('error.notFound'));
            
            return back();
        }

        // Set title
        $this->title($this->getShowTitle());

        // Generate show view
        $showContainer = GUI::container()->to($this->window);
        $this->generateShowView($showContainer, $model);

        // Buttons
        $buttonGroup = GUI::buttonGroup()
            ->to($this->window);

        // Add "Edit" button
        if ($this->isAllowedEdit())
        {
            $button = GUI::button($this->trans('button.edit'), 'primary')
                ->attr('href', $this->route('edit', $id))
                ->to($buttonGroup);

            // Customize "Edit" button
            $this->customizeEditButton($button);
        }

        // Add "Back" button
        $this->generateBackButton($buttonGroup);

        // Customize button group
        $this->customizeShowButtonGroup($buttonGroup);

        // Render window
        return $this->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find model
        try
        {
            $model = $this->modelCall('findOrFail', $id);
        }
        catch (ModelNotFoundException $e)
        {
            Flash::error($this->trans('error.notFound'));
            
            return back();
        }

        // Set title
        $this->title($this->getEditTitle());

        // Create form
        $form = GUI::form([ 'route' => [ $this->getFullRouteName('update'), $id ] ])
            ->to($this->window);

        // Show fields
        $this->generateEditForm($form, $model);

        // Buttons
        $buttonGroup = GUI::buttonGroup()
            ->to($form);

        // Add "Submit" button
        $button = GUI::submit($this->trans('button.update'))
            ->to($buttonGroup);

        // Customize "Edit" button
        $this->customizeEditSubmit($button);

        // Add "Back" button
        $this->generateBackButton($buttonGroup);

        // Customize button group
        $this->customizeEditButtonGroup($buttonGroup);

        // Render window
        return $this->render();
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
        if ($this->modelImplements(CRUDModelContract::class))
        {
            try
            {
                // Find model
                $model = $this->modelCall('findOrFail', $id);

                // Validate request
                $this->validate($request, $this->modelCall('getUpdateRules'));

                // Update item
                $model->fillForUpdate($request);
                $model->save();

                // Flash success message
                Flash::success($this->trans('message.update'));

                // Redirect
                return $this->redirect('index');
            }
            catch (ModelNotFoundException $e)
            {
                Flash::error($this->trans('error.notFound'));
            
                return back();
            }
        }
        else
        {
            throw new NotImplementedException('You need to implement [update] operation.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->modelCall('destroy', $id))
        {
            Flash::success($this->trans('message.destroy'));

            return back();
        }
        else
        {
            Flash::error($this->trans('error.notFound'));

            return back();
        }
    }
}