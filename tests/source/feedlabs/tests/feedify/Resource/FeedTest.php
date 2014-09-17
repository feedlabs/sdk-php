<?php

namespace Feedlabs\Tests\Feedify\Resource;

use Feedlabs\Tests\TestCase;
use Feedlabs\Feedify\Resource\Feed;

class FeedTest extends TestCase {

    public function testConstruct() {
        $feed = new Feed('foo', array('foo' => 'bar'));

        $this->assertSame('foo', $feed->getId());
        $this->assertSame(array('foo' => 'bar'), $feed->getData());
    }

    public function testDelete() {
        $request = $this->mockClass('Feedlabs\Feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('delete')->at(0, function ($path) {
            $this->assertSame('/feed/foo111', $path);
        });

        $feed = $this->mockClass('Feedlabs\Feedify\Resource\Feed')->newInstance(array('foo111', array('bar' => '123')));
        $feed->mockMethod('_getRequest')->set($request);

        /** @var Feed $feed */
        $feed->delete();
    }
}
