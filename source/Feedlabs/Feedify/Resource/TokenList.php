<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class TokenList
 * @package Feedlabs\Feedify\Resource
 */
class TokenList extends AbstractList {

    protected function _processItem($item) {
        return new Token(new Params($item));
    }
}
