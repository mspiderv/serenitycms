<?php

namespace Serenity\Modules\Http\Controllers\Architect;

use Illuminate\Http\Request;

use GUI;
use Modules;
use Serenity\Http\Requests;
use Serenity\Http\Controllers\ArchitectController;

class ModulesController extends ArchitectController
{
    protected function defaultTitle()
    {
        return 'Moduly';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Title
        $this->title('Moduly');

        // Box
        $box = GUI::box('Moduly')->to($this->window);

        // Table
        $table = GUI::table()->to($box);
        $table->datatable(false);
        $table->addColumns([ 'Názov modulu', 'Stav', 'Chránený', 'Možnosti' ]); // TODO

        foreach (Modules::all() as $module)
        {
            // Column: name
            $name = '<a href="' . route('architect.modules.show', $module->getName()) . '">' . $module->getName() . '</a>';

            // Column: status
            if ($module->isInstalled())
            {
                $status = '<span class="label label-success">Aktívny</span>';
            }
            else
            {
                $status = '<span class="label label-default">Neaktívny</span>';
            }

            // Column: protected
            if ($module->isProtected())
            {
                $protected = '<span class="label label-info">Áno</span>';
            }
            else
            {
                $protected = '<span class="label label-default">Nie</span>';
            }

            // Column: options
            // Active/Deactive link
            $options = '<a href="' . route('architect.modules.show', $module->getName()) . '" class="table-link">Zobraziť detaily</a>';

            if ( ! $module->isInstalled())
            {
                $options .= '<a href="' . route('architect.modules.install', $module->getName()) . '" class="table-link">Aktivovať modul</a>';

            }
            elseif ( ! $module->isProtected())
            {
                $options .= '<a href="' . route('architect.modules.uninstall', $module->getName()) . '" class="table-link">Deaktivovať modul</a>';
            }

            // Remove link
            if ( ! $module->isProtected())
            {
                $options .= '<a href="' . route('architect.modules.remove', $module->getName()) . '" class="table-link">Odstrániť modul</a>';
            }

            // Add row
            $table->addRow([
                $name,
                $status,
                $protected,
                $options
            ]);
        }

        // Render
        return $this->render();
    }

    public function show($moduleName)
    {
        // Get module instance
        $module = Modules::get($moduleName);

        // Title
        $this->title('Modul ' . $moduleName);

        // Box
        $box = GUI::box('Podrobnosti o module')->to($this->window);

        // TODO
        GUI::html(
        '<dl class="dl-horizontal">

            <dt>Názov modulu</dt>
            <dd>' . $module->getName() . '</dd>

            <dt>Cesta k modulu</dt>
            <dd>' . $module->getPath() . '</dd>

            <dt>Stav</dt>
            <dd>' . (($module->isInstalled()) ? '<span class="label label-success">Aktívny</span>' : '<span class="label label-default">Neaktívny</span>') . '</dd>

            <dt>Chránený</dt>
            <dd>' . (($module->isProtected()) ? '<span class="label label-info">Áno</span>' : '<span class="label label-default">Nie</span>') . '</dd>

            <dt>Poskytovatelia</dt>
            <dd>' . implode('<br>', $module->getProviders()) . '</dd>

            <dt>Súbory</dt>
            <dd>' . implode('<br>', $module->getFiles()) . '</dd>

            <dt>Inštalátor</dt>
            <dd>' . $module->getInstaller() . '</dd>

            <dt>Odinštalátor</dt>
            <dd>' . $module->getUninstaller() . '</dd>

        </dl>'
        )->to($box);

        // Buttons
        $buttonGroup = GUI::buttonGroup()->to($this->window);

        // TODO: aby sa napr. nezobrazil button "Deaktivovať" ak je modul protected, a pod.

        GUI::button('Späť na zoznam', 'primary')
            ->attr('href', route('architect.modules.index'))
            ->to($buttonGroup);

        if ( ! $module->isInstalled())
        {
            GUI::button('Aktivovať modul', 'success')
                ->attr('href', route('architect.modules.install', $moduleName))
                ->to($buttonGroup);
        }
        elseif ( ! $module->isProtected())
        {
            GUI::button('Deaktivovať modul', 'warning')
                ->attr('href', route('architect.modules.uninstall', $moduleName))
                ->to($buttonGroup);
        }

        if ( ! $module->isProtected())
        {
            GUI::button('Odstrániť modul', 'danger')
                ->attr('href', route('architect.modules.remove', $moduleName))
                ->to($buttonGroup);
        }

        // Render
        return $this->render();
    }

    public function install($module)
    {
        if (Modules::install($module))
        {
            return back()->withMessage('ok');
        }
        else
        {
            return back()->withErrors("Module [$module] installation failed.");
        }
    }

    public function uninstall($module)
    {
        if (Modules::uninstall($module))
        {
            return back()->withMessage('ok');
        }
        else
        {
            return back()->withErrors("Module [$module] uninstallation failed.");
        }
    }

    public function remove($module)
    {
        return back()->withErrors("Radšej nie...");

        /*if (Modules::remove($module))
        {
            return back()->withMessage('ok');
        }
        else
        {
            return back()->withErrors("Module [$module] removing failed.");
        }*/
    }
}
