<?php

namespace Serenity\Concrete;

// Generator class definition
class GUIGenerator
extends \Vitlabs\GUICore\AbstractGenerator
implements

// Implementing 3rd party contracts
\Vitlabs\GUIAdmin\Contracts\ElementsContract,
\Vitlabs\GUIAdmin\Contracts\FormContract,
\Vitlabs\GUIAdmin\Contracts\FileManagerContract,
\Vitlabs\GUICKEditor\Contracts\GeneratorMethodsContract

// Use 3rd party traits
{
    // "GUIAdminLTE" implementation of "GUIAdmin" ElementsContract and FormContract
    use \Vitlabs\GUIAdminLTE\Traits\ElementsTrait;
    use \Vitlabs\GUIAdminLTE\Traits\FormTrait;

    // "GUIElfinder" implementation of "GUIAdmin" FileManagerContract
    use \Vitlabs\GUIElfinder\Traits\FileManagerTrait;

    // "GUICKEditor"  implementation of "GUICKEditor" CKEditorContract
    use \Vitlabs\GUICKEditor\Traits\CKEditorTrait;
}