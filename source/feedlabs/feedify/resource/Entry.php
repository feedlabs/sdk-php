<?php

namespace Feedlabs\feedify\Resource;

use Feedlabs\feedify\Client;
use Feedlabs\feedify\Request;

/**
 * Class Entry
 * @package Feedlabs\feedify\Resource
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
