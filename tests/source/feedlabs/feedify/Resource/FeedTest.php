<?php

namespace feedlabs\tests\feedify\Resource;

use feedlabs\feedify\Resource\Feed;

class Resource_FeedTest extends \PHPUnit_Framework_TestCase {

    use \Mocka\MockaTrait;

    public function testConstruct() {
        $feed = new Feed('foo', array('foo' => 'bar'));

        $this->assertSame('foo', $feed->getId());
        $this->assertSame(array('foo' => 'bar'), $feed->getData());
    }

    public function testDelete() {
        $request = $this->mockClass('feedlabs\feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('delete')->at(0, function ($path) {
            $this->assertSame('/feed/foo111', $path);
        });

        $feed = $this->mockClass('feedlabs\feedify\Resource\Feed')->newInstance(array('foo111', array('bar' => '123')));
        $feed->mockMethod('_getRequest')->set($request);

        /** @var Feed $feed */
        $feed->delete();
    }
}
