<?php

namespace Tests\Traits;

trait AssertValidationErrorMessages {

    protected $response;

    protected function assertValidationErrorMessage(string $expectedValidationMessage)
    {
        $actualValidationMessage = $this->response['errors']['tag'];

        $this->assertContains($expectedValidationMessage, $actualValidationMessage); 
    }
}
