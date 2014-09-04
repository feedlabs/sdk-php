<?php

namespace feedlabs\tests\feedify;

use feedlabs\feedify\Resource_Entry;

class Resource_EntryTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct() {
        $entry = new Resource_Entry('foo', array('foo' => 'bar'));

        $this->assertSame('foo', $entry->getId());
        $this->assertSame(array('foo' => 'bar'), $entry->getData());
    }
}
