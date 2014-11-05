<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Request;
use Feedlabs\Feedify\Params;

/**
 * Class Feed
 * @package Feedlabs\Feedify\Resource
 */
class Feed extends AbstractElement {

    /** @var string */
    protected $_name;

    /** @var string */
    protected $_channel;

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
        $this->_channel = $data->getString('channel');
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
     * @return string
     */
    public function getChannel() {
        return $this->_channel;
    }

    /**
     * @return int
     */
    public function getCreated() {
        return $this->_createStamp;
    }

    public function getEntryList() {
        // todo: load over API
        $entryList = [];
        for ($i = 0; $i < 3; $i++) {
            $entryList[] = ['id' => 'id' . $i, 'data' => 'Data-' . $i, 'createStamp' => time()];
        }

        return new EntryList($entryList);
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
