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
        static::$_apiId = (string) $apiId;
        static::$_apiToken = (string) $apiToken;
    }

    /**
     * @param string $id
     * @return Feed
     */
    public function getFeed($id) {
        $id = (string) $id;
        $data = static::getRequest()->get('/feed/' . $id);
        return new Feed($id, $data);
    }

    /**
     * @return Feed[]
     */
    public function getFeedList() {
        $feedList = array();
        $result = static::getRequest()->get('/feed');
        foreach ($result as $feedData) {
            $feedList[] = new Feed($feedData['Id'], array('Data' => $feedData['Data']));
        }
        return $feedList;
    }

    /**
     * @param array $data
     * @return string
     */
    public function createFeed(array $data) {
        $result = static::getRequest()->post('/feed', $data);
        return $result['id'];
    }

    /**
     * @param string $id
     * @param array  $data
     */
    public function updateFeed($id, array $data) {
        static::getRequest()->put('/feed/' . $id, $data);
    }

    /**
     * @param string $id
     */
    public function deleteFeed($id) {
        static::getRequest()->delete('/feed/' . $id);
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
     * @return Request
     */
    public static function getRequest() {
        if (!static::$_request) {
            static::$_request = new Request(static::$_apiId, static::$_apiToken);
        }
        return static::$_request;
    }
}
