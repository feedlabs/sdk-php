<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Request;
use Feedlabs\Feedify\Params;

/**
 * Class Token
 * @package Feedlabs\Feedify\Resource
 */
class Token {

    /** @var string */
    protected $_token;

    /** @var string */
    protected $_name;

    /** @var int */
    protected $_createStamp;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        $this->_token = $data->getString('token');
        $this->_name = $data->getString('name');
        $this->_createStamp = $data->getInt('createStamp');
    }

    /**
     * @return string|null
     */
    public function getToken() {
        return $this->_token;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * @return int
     */
    public function getCreated() {
        return $this->_createStamp;
    }

    /**
     * @return array
     */
    public function delete() {
        // todo: add delete
    }

    /**
     * @return Request
     */
    protected function _getRequest() {
        return Client::getRequest();
    }
}
