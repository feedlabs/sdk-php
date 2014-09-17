<?php

namespace Feedlabs\Tests\Feedify;

use Feedlabs\Tests\TestCase;
use Feedlabs\Feedify\Client;

class ClientTest extends TestCase {

    public function testGetFeed() {
        $id = 'foo123';
        $data = array('fuck' => '123');

        $request = $this->mockClass('Feedlabs\Feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('get')->set($data);

        $mockClient = $this->mockClass('Feedlabs\Feedify\Client');
        $mockClient->mockStaticMethod('getRequest')->set(function () use ($request) {
            return $request;
        });
        /** @var Client $client */
        $client = $mockClient->newInstanceWithoutConstructor();
        $feed = $client->getFeed($id);

        $this->assertInstanceOf('\Feedlabs\Feedify\Resource\Feed', $feed);
        $this->assertSame($id, $feed->getId());
        $this->assertSame($data, $feed->getData());
    }

    public function testGetFeedList() {
    }

    public function testCreateFeed() {
    }

    public function testUpdateFeed() {
    }

    public function testDeleteFeed() {
    }

    public function testCreateEntry() {
    }

    public function testGetRequest() {
        $id = 'foo123';
        $token = 'bar123';

        $client = new Client($id, $token);
        $request = $client::getRequest();

        $this->assertInstanceOf('\Feedlabs\Feedify\Request', $request);
        $this->assertSame($id, $request->getApiId());
        $this->assertSame($token, $request->getApiToken());
    }
}
