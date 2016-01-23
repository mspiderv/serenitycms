<?php

namespace Serenity;

use Vitlabs\ModulesContracts\Contracts\InstallerContract;
use Vitlabs\ModulesContracts\Contracts\UninstallerContract;
use Vitlabs\ModulesContracts\Contracts\ModuleContract;
use Vitlabs\ModulesContracts\Contracts\ModulesManagerContract;

class ModuleInstaller implements InstallerContract, UninstallerContract
{

    public static function install(ModuleContract $module, ModulesManagerContract $modules)
    {
        \Log::info('Module [' . $module->getName() . '] installed successfully.');
    }

    public static function uninstall(ModuleContract $module, ModulesManagerContract $modules)
    {
        \Log::info('Module [' . $module->getName() . '] uninstalled successfully.');
    }

}
