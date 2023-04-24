<?php

namespace SundanceSolutions\SecurityPortalClient;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SundanceSolutions\SecurityPortalClient\Commands\SecurityPortalClientCommand;

class SecurityPortalClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('security-portal-client')
            ->hasConfigFile('security-portal-client')
            ->hasViews()
            ->hasMigration('create_security-portal-client_table')
            ->hasCommand(SecurityPortalClientCommand::class);
    }
}
