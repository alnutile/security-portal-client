<?php

namespace SundanceSolutions\SecurityPortalClient\Commands;

use Illuminate\Console\Command;
use SundanceSolutions\SecurityPortalClient\Facades\SecurityPortalClient;

class SecurityPortalClientCommand extends Command
{
    public $signature = 'security-portal-client:sync';

    public $description = 'Sync Users';

    public function handle(): int
    {
        $this->info('Starting');
        SecurityPortalClient::syncUserNames();
        $this->info('Complete');

        return self::SUCCESS;
    }
}
