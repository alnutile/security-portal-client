# Security Portal Client

This will be the client for the soon to be OpenSource portal

## Send users to the hub so we can monitor HaveIBeenPwned and Check for weak passwords

## Setup 

```bash
composer require sundance-solutions/security-portal-client
```

```dotenv
SECURITY_PORTAL_TOKEN=TOKEN_FROM_APP
SECURITY_PORTAL_URL=URL_FROM_APP 
```

The token you can get from logging into our dashboard, clicking under your icon on the top right and API Token.


### Scheduler
```php
$schedule->command('security-portal-client:sync')->environments('production')->hourly();
```

## Config

You can publish it:

```bash 
php artisan vendor:publish --config=security-portal-client-config
```
