<?php

namespace Serenity\Fields;

use ErrorException;
use Serenity\Fields\Contracts\FieldContract;
use Serenity\Fields\Contracts\FieldsManagerContract;

class FieldsManager implements FieldsManagerContract
{
	protected $fields = [];
	protected $humanNames = [];

    public function register($fieldClass)
    {
		$this->check($fieldClass);

		if ( ! $this->isRegistered($fieldClass))
		{
			$this->fields[] = $fieldClass;
			$this->humanNames[$fieldClass] = $fieldClass::getHumanName();
		}

		return $this;
    }

    public function deregister($fieldClass)
    {
		if(($key = array_search($fieldClass, $this->fields)) !== false)
		{
		    unset($this->fields[$key]);
		}

		return $this;
    }

    public function isRegistered($fieldClass)
    {
		return in_array($fieldClass, $this->fields);
    }

    public function getRegistered()
    {
		return $this->fields;
    }

    public function field($fieldClass)
    {
		$this->check($fieldClass);

		return new $fieldsClass;
    }

	public function getHumanNames()
	{
		return $this->humanNames;
	}

	protected function check($fieldClass)
    {
		if ( ! $this->implementsContract($fieldClass))
        {
			throw new ErrorException('Field class must implements interface Serenity\Fields\Contracts\FieldContract.');
        }
    }

	protected function implementsContract($fieldClass)
    {
		return isset(class_implements($fieldClass)[FieldContract::class]);
    }

}
