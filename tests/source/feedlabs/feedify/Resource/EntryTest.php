<?php

namespace feedlabs\tests\feedify\Resource;

use feedlabs\feedify\Resource\Entry;

class Resource_EntryTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct() {
        $entry = new Entry('foo', array('foo' => 'bar'));

        $this->assertSame('foo', $entry->getId());
        $this->assertSame(array('foo' => 'bar'), $entry->getData());
    }
}
