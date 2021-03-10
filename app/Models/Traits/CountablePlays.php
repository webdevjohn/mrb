<?php

namespace App\Models\Traits;

trait CountablePlays {

	public function incPlayedCounter()
	{
		$this->played_counter += 1;
        return $this;
	}
}