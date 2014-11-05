<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class AbstractResource
 * @package Feedlabs\Feedify\Resource
 */
abstract class AbstractElement {

    /** @var string */
    protected $_id;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        $this->_id = $data->getString('id');
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->_id;
    }
}
