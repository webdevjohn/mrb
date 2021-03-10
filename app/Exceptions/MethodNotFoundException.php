<?php

namespace App\Exceptions;

use Exception;

class MethodNotFoundException extends Exception
{
    protected $entity, $method;

    public function __construct($entity, string $method)
    {
        $this->entity = $entity;
        $this->method = $method;
    }

    public function render($request)
    {
        return  "<b>". $this->method . "</b> method not found in <b>" . get_class($this->entity) . "</b>";
    }

}