<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Request;
use Feedlabs\Feedify\Params;

/**
 * Class Entry
 * @package Feedlabs\Feedify\Resource
 */
class Entry extends AbstractElement {

    /** @var array */
    protected $_data;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        parent::__construct($data);
        $this->_data = $data->getString('data');
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
