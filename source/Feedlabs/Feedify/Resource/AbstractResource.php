<?php

namespace Feedlabs\Feedify\Resource;

/**
 * Class AbstractResource
 * @package Feedlabs\Feedify\Resource
 */
abstract class AbstractResource {

    /** @var string */
    protected $_id;

    /**
     * @param string $id
     */
    public function __construct($id) {
        $this->_id = (string) $id;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->_id;
    }
}
