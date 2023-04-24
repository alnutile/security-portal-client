<?php

namespace SundanceSolutions\SecurityPortalClient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SundanceSolutions\SecurityPortalClient\Exceptions\MissingTokenException;

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
        if (! $lastChecked) {
            $this->userModel::orderBy('id')
                ->chunk(10, function ($users) {
                $payload = $users;
                $this->http()->post($this->uri.'/client_users', $payload);
            });
        }
    }
}
