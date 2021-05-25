<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('isCheckBoxSelected', function (array|null $selectedCheckBoxes, string $currentElement) {
            if ($selectedCheckBoxes) {		
				foreach ($selectedCheckBoxes as $selectedCheckBox) 
				{
					if ($selectedCheckBox == $currentElement) 
					{
						return "checked=checked";
					}
				}
		    }
        });
    }
}
