<?php

namespace App\Models\Traits;

trait CountableViews {

    public function incViewedCounter()
	{
		$this->viewed_counter += 1;
        return $this;
    }
}