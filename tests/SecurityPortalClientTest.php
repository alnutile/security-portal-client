<?php
namespace SundanceSolutions\SecurityPortalClient\Tests;

use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use SundanceSolutions\SecurityPortalClient\Facades\SecurityPortalClient;
use SundanceSolutions\SecurityPortalClient\SecurityPortalClient as SecurityPortalClientNonFacade;
use SundanceSolutions\SecurityPortalClient\Tests\User;

class SecurityPortalClientTest extends TestCase
{
    public function testCanGetUrl()
    {
        $url = SecurityPortalClient::getUrl();
        $this->assertNotNull($url);
    }

    public function testDoesNotCall()
    {
        Http::fake();
        $mock = $this->mock(User::class, function (MockInterface $mock) {
            $mock->shouldReceive('orderBy->chunk')
                ->once()
                ->andReturn([]);
        });
        $client = new SecurityPortalClientNonFacade($mock);
        $client->syncUserNames();
        Http::assertNothingSent();
    }

    public function testCallsApi()
    {
        Http::fake([
            'securityportal.io/*' => Http::response([], 200),
        ]);

        $mock = $this->mock(User::class, function (MockInterface $mock) {

            $mock->shouldReceive('orderBy->chunk')
                ->once()
                ->andReturnUsing(function($chunkSize, $callback) {
                   $callback(range(1,10));
                });
        });

        $client = new SecurityPortalClientNonFacade($mock);
        $client->syncUserNames();
        Http::assertSentCount(1);
    }


}
