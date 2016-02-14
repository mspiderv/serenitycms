<?php

namespace Serenity\Fields\Implementations;

use Vitlabs\GUIAdminLTE\FormElements\Input;
use Serenity\Fields\Contracts\FieldContract;

class InputField extends Input implements FieldContract
{
	public static function getHumanName()
	{
		return "Textové pole"; // TODO: tu by som asi mohol pouzit helepr-funkciu "trans_class()"
	}
}
