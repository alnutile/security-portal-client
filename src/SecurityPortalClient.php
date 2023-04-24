<?php

namespace SundanceSolutions\SecurityPortalClient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SundanceSolutions\SecurityPortalClient\Exceptions\MissingTokenException;
use SundanceSolutions\SecurityPortalClient\Exceptions\RequestErrorException;

class SecurityPortalClient
{
    protected $uri = '/api/security/hub';

    /**
     * @var Model
     */
    protected $userModel;

    public function __construct($userModel = null)
    {
        if ($userModel) {
            $this->userModel = $userModel;
        } else {
            $this->userModel = config('security-portal-client.users_model');
        }
    }

    public function getUrl()
    {
        return config('security-portal-client.url');
    }

    public function http()
    {
        $token = config('security-portal-client.api_token');

        if (! $token) {
            throw new MissingTokenException();
        }

        return Http::withToken($token)->baseUrl($this->getUrl());
    }

    public function syncUserNames()
    {
        $lastChecked = Cache::get('security_portal.sync_users');
        $this->userModel::orderBy('id')
            ->chunk(10, function ($users) {
                $payload['data'] = $users;
                $payload['source_domain'] = config("app.url");

                $results = $this->http()->post($this->uri.'/client_users', $payload);

                if($results->successful()) {
                    logger("Success");
                } else {
                    throw new RequestErrorException("Error with status " . $results->status());
                }
        });
    }
}
