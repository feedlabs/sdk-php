<?php

namespace Feedlabs\Feedify;

use Feedlabs\Feedify\Client\AdminUserClient;
use Feedlabs\Feedify\Client\ApplicationClient;
use Feedlabs\Feedify\Client\EntryClient;
use Feedlabs\Feedify\Client\FeedClient;
use Feedlabs\Feedify\Client\TokenClient;

/**
 * Class Client
 * @package Feedlabs\Feedify
 */
class Client {

    CONST API_VERSION = 1;

    /** @var ApplicationClient */
    public $application;

    /** @var FeedClient */
    public $feed;

    /** @var EntryClient */
    public $entry;

    /** @var AdminUserClient */
    public $adminUser;

    /** @var TokenClient */
    public $token;

    /** @var string */
    private static $_apiToken;

    /** @var Request */
    private static $_request;

    /**
     * @param string $apiToken
     */
    public function __construct($apiToken) {
        static::$_apiToken = (string) $apiToken;

        $this->application = new ApplicationClient();
        $this->feed = new FeedClient();
        $this->entry = new EntryClient();
        $this->adminUser = new AdminUserClient();
        $this->token = new TokenClient();
    }

    /**
     * @return Request
     */
    public static function getRequest() {
        if (!static::$_request) {
            static::$_request = new Request(static::$_apiToken);
        }
        return static::$_request;
    }
}
