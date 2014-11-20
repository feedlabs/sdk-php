<?php

namespace Feedlabs\Tests\Feedify;

use Feedlabs\Tests\TestCase;
use Feedlabs\Feedify\Request;

class RequestTest extends TestCase {

    public function testConstruct() {
        $request = new Request('bar');
        $this->assertSame('bar', $request->getApiToken());
    }

    public function testGet() {
        $request = $this->mockClass('Feedlabs\Feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('_send')->set('{"111": {"Id": "111","Data": "foo","Entries": {}}}');

        $expected = ['111' => ['Id' => '111', 'Data' => 'foo', 'Entries' => []]];
        /** @var Request $request */
        $this->assertSame($expected, $request->get('www.example.com'));
    }

    public function testPost() {
        $request = $this->mockClass('Feedlabs\Feedify\Request')->newInstanceWithoutConstructor();
        $request->mockMethod('_send')->set('{"id": "111"}');

        $expected = ['id' => '111'];
        /** @var Request $request */
        $this->assertSame($expected, $request->post('www.example.com', $expected));
    }
}
