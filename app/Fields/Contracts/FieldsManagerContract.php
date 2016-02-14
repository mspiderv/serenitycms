<?php

namespace Serenity\Fields\Contracts;

interface FieldsManagerContract
{
    function register($fieldClass);

    function deregister($fieldClass);

    function isRegistered($fieldClass);

    function getRegistered();

    function getHumanNames();

    function field($fieldClass);
}
