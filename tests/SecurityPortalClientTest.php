<?php

use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use SundanceSolutions\SecurityPortalClient\Facades\SecurityPortalClient;
use SundanceSolutions\SecurityPortalClient\SecurityPortalClient as SecurityPortalClientNonFacade;
use SundanceSolutions\SecurityPortalClient\Tests\User;

it('can_get_url', function () {
    $url = SecurityPortalClient::getUrl();
    $this->assertNotNull($url);
});

it('test_does_not_call', function () {
    Http::fake();
    SecurityPortalClient::syncUserNames();
    Http::assertNothingSent();
});

it('test_calls_api', function () {
    Http::fake([
        'securityportal.io/*' => Http::response([], 200),
    ]);

    $mock = $this->mock(User::class, function (MockInterface $mock) {
        $mock->shouldReceive('orderBy->chunk')
            ->once()
            ->andReturn(range(1, 10));
    });
    $client = new SecurityPortalClientNonFacade($mock);
    $client->syncUserNames();
    Http::assertSentCount(1);
});
