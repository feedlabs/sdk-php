<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class FeedList
 * @package Feedlabs\Feedify\Resource
 */
class FeedList extends AbstractList {

    protected function _processItem($item) {
        return new Feed(new Params($item));
    }
}
