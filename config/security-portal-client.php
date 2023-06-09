<?php

// config for SundanceSolutions/SecurityPortalClient
return [
    'api_token' => env('SECURITY_PORTAL_TOKEN', null),
    'url' => env('SECURITY_PORTAL_URL', 'https://securityportal.io'),
    /** @phpstan-ignore-next-line */
    'users_model' => \App\Models\User::class,
];
