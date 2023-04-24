<?php

namespace SundanceSolutions\SecurityPortalClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SundanceSolutions\SecurityPortalClient\SecurityPortalClient
 */
class SecurityPortalClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SundanceSolutions\SecurityPortalClient\SecurityPortalClient::class;
    }
}
