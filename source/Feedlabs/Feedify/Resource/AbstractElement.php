<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Params;
use Feedlabs\Feedify\Request;

/**
 * Class AbstractElement
 * @package Feedlabs\Feedify\Resource
 */
abstract class AbstractElement {

    /** @var string */
    protected $_id;

    /** @var int */
    protected $_createStamp;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        $this->_id = $data->getString('id');
        $this->_createStamp = ($data->has('createStamp')) ? $data->getInt('createStamp') : null;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * @return int
     */
    public function getCreated() {
        if (null === $this->_createStamp) {
            $this->_load();
        }
        return $this->_createStamp;
    }

    /**
     * @return Request
     */
    protected function _getRequest() {
        return Client::getRequest();
    }

    abstract protected function _load();
}
