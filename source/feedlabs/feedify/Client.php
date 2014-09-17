<?php

namespace Feedlabs\Feedify;

use Feedlabs\Feedify\Resource\Feed;

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
        self::$_apiId = $apiId;
        self::$_apiToken = $apiToken;
    }

    /**
     * @param $id
     * @return Feed
     */
    public function getFeed($id) {
        $id = (string) $id;
        $data = self::getRequest()->get('/feed/' . $id);
        return new Feed($id, $data);
    }

    /**
     * @return Feed[]
     */
    public function getFeedList() {
        $return = array();
        $feedList = self::getRequest()->get('/feed');
        foreach ($feedList as $feed) {
            $return[] = new Feed($feed['Id'], array('Data' => $feed['Data']));
        }
        return $return;
    }

    /**
     * @param array $data
     * @return string
     */
    public function createFeed(array $data) {
        $result = self::getRequest()->post('/feed', $data);
        return $result['id'];
    }

    public function updateFeed($id, array $data) {
        // self::getRequest()->put('/feed/' . $id, $data);
    }

    /**
     * @param string $id
     */
    public function deleteFeed($id) {
        self::getRequest()->delete('/feed/' . $id);
    }

    /**
     * @param string $feedId
     * @param array  $data
     * @return string
     */
    public function createEntry($feedId, array $data) {
        $result = self::getRequest()->post('/feed/' . $feedId . '/entry', $data);
        return $result['id'];
    }

    /**
     * @return Request
     */
    public static function getRequest() {
        if (!self::$_request) {
            self::$_request = new Request(self::$_apiId, self::$_apiToken);
        }
        return self::$_request;
    }
}
