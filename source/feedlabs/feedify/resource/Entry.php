<?php

namespace feedlabs\feedify\Resource;

use feedlabs\feedify\Client;
use feedlabs\feedify\Request;

/**
 * Class Entry
 * @package feedlabs\feedify\Resource
 */
class Entry extends AbstractResource {

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
     * @return Request
     */
    protected function _getRequest() {
        return Client::getRequest();
    }
}
