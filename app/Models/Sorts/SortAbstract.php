<?php

namespace App\Models\Sorts;

abstract class SortAbstract {
    abstract function sort($query, string $orderBy);	
}
