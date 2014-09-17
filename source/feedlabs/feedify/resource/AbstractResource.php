<?php

namespace Feedlabs\feedify\Resource;

/**
 * Class AbstractResource
 * @package Feedlabs\feedify\Resource
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
