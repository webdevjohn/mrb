<?php

namespace App\Services\Basket;

class TrackBasket extends Basket {

    /**
     * Sets the session key.
     *
     * @return void
     */
    protected function setSessionKey()
    {
        $this->sessionKey = 'trackBasket';
    }
}
