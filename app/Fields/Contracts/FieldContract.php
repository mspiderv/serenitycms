<?php

namespace Serenity\Fields\Contracts;

use Vitlabs\GUICore\Contracts\Components\FieldContract as GUIFieldContract;

interface FieldContract extends GUIFieldContract
{
	static function getHumanName();
}
