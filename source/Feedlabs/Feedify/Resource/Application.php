<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Request;
use Feedlabs\Feedify\Params;

/**
 * Class Application
 * @package Feedlabs\Feedify\Resource
 */
class Application extends AbstractElement {

    /** @var string */
    protected $_name;

    /** @var string|null */
    protected $_description;

    /** @var int */
    protected $_createStamp;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        parent::__construct($data);
        $this->_name = $data->getString('name');
        $this->_createStamp = $data->getInt('createStamp');
        $this->_description = ($data->has('description')) ? $data->getString('description') : null;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * @return string|null
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     * @return int
     */
    public function getCreated() {
        return $this->_createStamp;
    }

    public function getFeedList() {
        // todo: load over API
        $feedList = [];
        for ($i = 0; $i < 3; $i++) {
            $feedList[] = ['id' => 'id' . $i, 'name' => 'Name-' . $i, 'description' => 'description-' . $i, 'createStamp' => time(), 'channel'     => 'channel' . $i];
        }

        return new FeedList($feedList);
    }

    /**
     * @return array
     */
    public function delete() {
        // todo: add delete
        // return $this->_getRequest()->delete('/feed/' . $this->getId());
    }

    /**
     * @return Request
     */
    protected function _getRequest() {
        return Client::getRequest();
    }
}
