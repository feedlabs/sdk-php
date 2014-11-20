<?php

namespace Feedlabs\Feedify\Client;

use Feedlabs\Feedify\Params;
use Feedlabs\Feedify\Resource\Feed;
use Feedlabs\Feedify\Resource\FeedList;

/**
 * Class FeedClient
 * @package Feedlabs\Feedify\Client
 */
class FeedClient {

    /**
     * @param string $applicationId
     * @return FeedList
     */
    public function getList($applicationId) {
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
    public function get($applicationId, $feedId) {
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

    public function create($applicationId, $name, $description = null, $tagList = null) {
        // todo: add
    }

    public function update($applicationId, $feedId, $name, $description = null, $tagList = null) {
        // todo: add
    }

    /**
     * @param string $applicationId
     * @param string $feedId
     */
    public function delete($applicationId, $feedId) {
        // todo: add
    }
}
