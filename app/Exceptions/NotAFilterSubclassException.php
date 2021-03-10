<?php

namespace App\Exceptions;

use Exception;

class NotAFilterSubclassException extends Exception
{
    protected $class;

    public function __construct($class, $filterSubclassNamespace)
    {
        $this->class = $class;
        $this->filterSubclassNamespace = $filterSubclassNamespace;
    }

    public function render($request)
    {
        return  "<b>" . $this->class . "</b> is not a subclass of " . $this->filterSubclassNamespace;
    }

}