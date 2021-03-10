<?php

namespace App\Exceptions;

use Exception;

class NotASortSubclassException extends Exception
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function render($request)
    {
        return  "<b>" . $this->class . "</b> is not a subclass of App\Models\Sorts\SortAbstract";
    }
}
