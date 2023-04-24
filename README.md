# Security Portal Client

This will be the client for the soon to be OpenSource portal

## Send users to the hub so we can monitor HaveIBeenPwned and Check for weak passwords

## Setup 

```dotenv
SECURITY_PORTAL_TOKEN=TOKEN_FROM_APP
SECURITY_PORTAL_URL=URL_FROM_APP 
```

### Scheduler
```php
  $schedule->command('security-portal-client:sync')->hourly();
```

