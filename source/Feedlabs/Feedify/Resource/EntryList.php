<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class EntryList
 * @package Feedlabs\Feedify\Resource
 */
class EntryList extends AbstractList {

    protected function _processItem($item) {
        return new Entry(new Params($item));
    }
}
