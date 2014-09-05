<?php

namespace feedlabs\tests\feedify;

use feedlabs\feedify\Request;

class RequestTest extends \PHPUnit_Framework_TestCase {

    use \Mocka\MockaTrait;

    public function testConstruct() {
        $request = new Request('foo', 'bar');

        $this->assertSame('foo', $request->getApiId());
        $this->assertSame('bar', $request->getApiToken());
    }

    public function testGet() {
        $request = $this->mockClass('feedlabs\feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('_send')->set('{"111": {"Id": "111","Data": "foo","Entries": {}}}');

        $expected = ['111' => ['Id' => '111', 'Data' => 'foo', 'Entries' => []]];
        /** @var Request $request */
        $this->assertSame($expected, $request->get('www.example.com'));
    }

    public function testPost() {
        $request = $this->mockClass('feedlabs\feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('_send')->set('{"id": "111"}');

        $expected = ['id' => '111'];
        /** @var Request $request */
        $this->assertSame($expected, $request->get('www.example.com'));
    }
}
