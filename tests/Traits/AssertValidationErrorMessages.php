<?php

namespace Tests\Traits;

trait AssertValidationErrorMessages {

    protected function assertValidationErrorMessage(string $expectedValidationMessage, array $actualValidationMessage)
    {
        $this->assertContains($expectedValidationMessage, $actualValidationMessage); 
    }
}
