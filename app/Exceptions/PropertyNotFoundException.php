<?php

namespace App\Exceptions;

use Exception;

class PropertyNotFoundException extends Exception
{
    protected $class, $property;

    public function __construct($class, string $property)
    {
        $this->class = $class;
        $this->property = $property;
    }

    public function render($request)
    {
        return  "<b>". $this->property . "</b> property not found in <b>" . get_class($this->class) . "</b>";
    }
}
