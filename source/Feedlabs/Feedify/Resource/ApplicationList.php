<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class ApplicationList
 * @package Feedlabs\Feedify\Resource
 */
class ApplicationList extends AbstractList {

    protected function _processItem($item) {
        return new Application(new Params($item));
    }
}
