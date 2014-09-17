<?php

namespace Feedlabs\feedify\Resource;

use Feedlabs\feedify\Client;
use Feedlabs\feedify\Request;

/**
 * Class Feed
 * @package Feedlabs\feedify\Resource
 */
class Feed extends AbstractResource {

    /** @var array */
    protected $_data;

    /**
     * @param string $id
     * @param array  $data
     */
    public function __construct($id, array $data) {
        parent::__construct($id);
        $this->_data = $data;
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->_data;
    }

    /**
     * @return array
     */
    public function delete() {
        return $this->_getRequest()->delete('/feed/' . $this->getId());
    }

    /**
     * @return Request
     */
    protected function _getRequest() {
        return Client::getRequest();
    }
}
