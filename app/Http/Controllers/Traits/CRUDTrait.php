<?php

namespace Serenity\Http\Controllers\Traits;

use GUI;
use Route;
use Flash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Vitlabs\GUIAdmin\Contracts\Elements\TableContract;
use Vitlabs\GUIAdmin\Contracts\Elements\BoxContract;
use Vitlabs\GUIAdmin\Contracts\Elements\ButtonGroupContract;
use Vitlabs\GUIAdmin\Contracts\Elements\ButtonContract;
use Vitlabs\GUIAdmin\Contracts\FormElements\SubmitContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;
use Vitlabs\GUIAdmin\Contracts\FormElements\FormContract;

trait CRUDTrait
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
    protected function customizeCreateSubmit(SubmitContract $submit) { }
    protected function customizeEditSubmit(SubmitContract $submit) { }
    protected function generateUniversalForm(FormContract $form, $id = null) { }

    // Default implementations
    protected function getTableColumns()
    {
        return [ '' ];
    }

    protected function getTableRowData($row)
    {
        return [
            $row->getKey()
        ];
    }

    protected function getTableRows()
    {
        return call_user_func($this->getModel() . '::all');
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
            $options .= '<a href="' . $this->route('show', $row->getKey()) . '" class="table-link">Show</a>';

        // Add "Edit" button
        if ($this->isAllowedEdit())
            $options .= '<a href="' . $this->route('edit', $row->getKey()) . '" class="table-link">Edit</a>';

        // Add "Delete" button
        if ($this->isAllowedDestroy())
            $options .= '<a href="' . $this->route('destroy', $row->getKey()) . '" class="table-link">Delete</a>';

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

    protected function getSortGroup()
    {
        return 'main_group';
    }

    protected function canSort()
    {
        return in_array('Vitlabs\OrderableModel\Contracts\OrderableModelContract', class_implements($this->getModel()));
    }

    protected function getEntitySingularName()
    {
        // TODO
        return "SINGULAR_ENTITY_NAME";
    }

    protected function getEntityPluralName()
    {
        // TODO
        return "PLURAL";
    }

    // Title methods
    protected function getIndexTitle()
    {
        return $this->getEntityPluralName();
    }

    protected function getCreateTitle()
    {
        return 'Create a new ' . lcfirst($this->getEntitySingularName());
    }

    protected function getShowTitle()
    {
        return $this->getEntitySingularName();
    }

    protected function getEditTitle()
    {
        return 'Edit ' . lcfirst($this->getEntitySingularName());
    }

    protected function generateBackButton(ContainerElement $container)
    {
        if ($this->isAllowedIndex())
        {
            $button = GUI::button("Show all " . lcfirst($this->getEntityPluralName()), 'default')
                ->attr('href', $this->route('index'))
                ->to($container);

            $this->customizeBackButton($button);
        }
    }

    protected function generateCreateForm(FormContract $form)
    {
        return $this->generateUniversalForm($form, null);
    }

    protected function generateEditForm(FormContract $form, $id)
    {
        return $this->generateUniversalForm($form, $id);
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
            ->appendAttribute('style', 'padding-bottom: 20px;')
            ->to($this->window);

        // Add "Create" button
        if ($this->isAllowedCreate())
        {
            $button = GUI::button("Create a new " . lcfirst($this->getEntitySingularName()), 'primary')
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
        $columns[] = 'Options';

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
        $button = GUI::submit("Store new " . lcfirst($this->getEntitySingularName()))
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Set title
        $this->title($this->getShowTitle());

        // TODO

        // Buttons
        $buttonGroup = GUI::buttonGroup()
            ->to($this->window);

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
        // TODO: check for existence
        
        try
        {
            $model = call_user_func($this->getModel() . '::findOrFail', $id);
        }
        catch (ModelNotFoundException $e)
        {
            Flash::error("Item with id [$id] does not exist.");
            return $this->redirect('index');
        }

        // Set title
        $this->title($this->getEditTitle());

        // Create form
        $form = GUI::form([ 'route' => [ $this->getFullRouteName('update'), $id ] ])
            ->to($this->window);

        // Show fields
        $this->generateEditForm($form, $id);

        // Buttons
        $buttonGroup = GUI::buttonGroup()
            ->to($form);

        // Add "Submit" button
        $button = GUI::submit("Update " . lcfirst($this->getEntitySingularName()))
            ->to($buttonGroup);

        // Customize "Update" button
        $this->customizeEditSubmit($button);

        // Add "Back" button
        $this->generateBackButton($buttonGroup);

        // Customize button group
        $this->customizeEditButtonGroup($buttonGroup);

        // Render window
        return $this->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (call_user_func($this->getModel() . '::destroy', $id))
        {
            Flash::success('Item has been successfuly deleted!');

            return back();
        }
        else
        {
            return back()->withErrors("Deleting failed.");
        }
    }
}