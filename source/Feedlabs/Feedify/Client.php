<?php

namespace Feedlabs\Feedify;

use Feedlabs\Feedify\Resource\Application;
use Feedlabs\Feedify\Resource\ApplicationList;
use Feedlabs\Feedify\Resource\Feed;
use Feedlabs\Feedify\Resource\FeedList;
use Feedlabs\Feedify\Resource\Token;
use Feedlabs\Feedify\Resource\TokenList;

/**
 * Class Client
 * @package Feedlabs\Feedify
 */
class Client {

    CONST API_VERSION = 1;

    /** @var string */
    private static $_apiId;

    /** @var string */
    private static $_apiToken;

    /** @var Request */
    private static $_request;

    /**
     * @param string $apiId
     * @param string $apiToken
     */
    public function __construct($apiId, $apiToken) {
        static::$_apiId = (string) $apiId;
        static::$_apiToken = (string) $apiToken;
    }

    /**
     * @return ApplicationList
     */
    public function getApplicationList() {
        // $result = static::getRequest()->get('/feed');
        // foreach ($result as $feedData) {
        //     $applicationList[] = new Feed($feedData['Id'], array('Data' => $feedData['Data']));
        // }
        // todo: load over API

        $applicationList = [];
        for ($i = 0; $i < 5; $i++) {
            $applicationList[] = ['id' => 'id' . $i, 'name' => 'Name-' . $i, 'description' => 'description-' . $i, 'createStamp' => time()];
        }

        return new ApplicationList($applicationList);
    }

    /**
     * @param string $applicationId
     * @return Application
     */
    public function getApplication($applicationId) {
        $applicationId = (string) $applicationId;
        // $data = static::getRequest()->get('/feed/' . $id);
        // todo: load over API

        $data = new Params([
            'id'          => $applicationId,
            'name'        => 'Name-' . $applicationId,
            'description' => 'description' . $applicationId,
            'createStamp' => time(),
        ]);
        return new Application($data);
    }

    /**
     * @param string $applicationId
     * @return FeedList
     */
    public function getFeedList($applicationId) {
        $applicationId = (string) $applicationId;
        // $result = static::getRequest()->get('/feed');
        // foreach ($result as $feedData) {
        //     $applicationList[] = new Feed($feedData['Id'], array('Data' => $feedData['Data']));
        // }
        // todo: load over API

        $feedList = [];
        for ($i = 0; $i < 5; $i++) {
            $feedList[] = [
                'id'          => 'id' . $i,
                'name'        => 'Name-' . $i,
                'description' => 'description-' . $i,
                'channel'     => 'channel-' . $i,
                'createStamp' => time(),
            ];
        }

        return new FeedList($feedList);
    }

    /**
     * @param string $applicationId
     * @param string $feedId
     * @return Feed
     */
    public function getFeed($applicationId, $feedId) {
        //        $feedId = (string) $feedId;
        //        $data = static::getRequest()->get('/application/' . $applicationId . '/feed/' . $feedId);
        //        return new Feed(new Params($data));

        $applicationId = (string) $applicationId;
        $feedId = (string) $feedId;
        // $data = static::getRequest()->get('/feed/' . $id);
        // todo: load over API

        $data = new Params([
            'id'          => $feedId,
            'name'        => 'Name-' . $feedId,
            'description' => 'description' . $feedId,
            'channel'     => 'channel' . $feedId,
            'createStamp' => time(),
        ]);
        return new Feed($data);
    }

    /**
     * @param string $applicationId
     * @param array  $data
     * @return string
     */
    public function createFeed($applicationId, array $data) {
        $result = static::getRequest()->post('/application/' . $applicationId . '/feed', $data);
        // todo: also return channel Id
        return $result['id'];
    }

    /**
     * @param string $applicationId
     * @param string $feedId
     * @param array  $data
     */
    public function updateFeed($applicationId, $feedId, array $data) {
        static::getRequest()->put('/application/' . $applicationId . '/feed/' . $feedId, $data);
    }

    /**
     * @param string $applicationId
     * @param string $feedId
     */
    public function deleteFeed($applicationId, $feedId) {
        static::getRequest()->delete('/application/' . $applicationId . '/feed/' . $feedId);
    }

    /**
     * @param string $feedId
     * @param array  $data
     * @return string
     */
    public function createEntry($feedId, array $data) {
        $result = static::getRequest()->post('/feed/' . $feedId . '/entry', $data);
        return $result['id'];
    }

    /**
     * @param string $feedId
     * @param string $entryId
     * @param array  $data
     */
    public function updateEntry($feedId, $entryId, array $data) {
        static::getRequest()->put('/feed/' . $feedId . '/entry/' . $entryId, $data);
    }

    /**
     * @param string $feedId
     * @param string $entryId
     */
    public function deleteEntry($feedId, $entryId) {
        static::getRequest()->delete('/feed/' . $feedId . '/entry/' . $entryId);
    }

    /**
     * @param string $token
     * @return Token
     */
    public function getToken($token) {
        $token = (string) $token;
        // todo: load over API

        return new Token(new Params(['token' => $token, 'name' => 'Namedjgsfjhsdgfhjsfgdshj', 'createStamp' => time()]));
    }

    public function getTokenList() {
        // todo: load over API

        $tokenList = [];
        for ($i = 0; $i < 5; $i++) {
            $tokenList[] = ['token' => 'token' . $i, 'name' => 'Name-' . $i, 'createStamp' => time()];
        }

        return new TokenList($tokenList);
    }

    /**
     * @return Request
     */
    public static function getRequest() {
        if (!static::$_request) {
            static::$_request = new Request(static::$_apiId, static::$_apiToken);
        }
        return static::$_request;
    }
}
