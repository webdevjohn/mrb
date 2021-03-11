<?php 
namespace App\Helpers;

class FormControl {

    public function isRadioButtonSelected($arg1, $arg2)
    {
    	if ($arg1 == $arg2) {
    		return "checked=checked";
    	}
    	return null;
    }

    public function isCheckBoxSelected(array $checkBoxes, $arg2)
    {
    	if ($checkBoxes) 
    	{
	    	foreach ($checkBoxes as $checkBoxValue) 
	    	{
	    		if ($checkBoxValue == $arg2) 
	    		{
	    			return "checked=checked";
	    		}
	    	}
   		}

    	return false;
    }


    public function isSelectBoxSelected($value, $oldValue) 
    {
        if ($value == $oldValue) return 'selected="selected"';
    }
}
