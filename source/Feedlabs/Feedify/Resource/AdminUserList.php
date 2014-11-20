<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class AdminUserList
 * @package Feedlabs\Feedify\Resource
 */
class AdminUserList extends AbstractList {

    protected function _processItem($item) {
        return new AdminUser(new Params($item));
    }
}
