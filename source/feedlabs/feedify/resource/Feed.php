<?php

namespace feedlabs\feedify\Resource;

use feedlabs\feedify\Client;
use feedlabs\feedify\Request;

/**
 * Class Feed
 * @package feedlabs\feedify\Resource
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

    public function update(array $data) {
        $this->_getRequest()->put('/feed/' . $this->getId(), $data);
    }

    public function delete() {
        $this->_getRequest()->delete('/feed/' . $this->getId());
    }

    /**
     * @return Request
     */
    protected function _getRequest() {
        return Client::getRequest();
    }
}
