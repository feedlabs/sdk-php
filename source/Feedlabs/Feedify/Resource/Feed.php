<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Params;

/**
 * Class Feed
 * @package Feedlabs\Feedify\Resource
 */
class Feed extends AbstractElement {

    /** @var string */
    protected $_name;

    /** @var string */
    protected $_channelId;

    /** @var string */
    protected $_description;

    /** @var EntryList */
    protected $_entryList;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        parent::__construct($data);
        $this->_name = ($data->has('name')) ? $data->getString('name') : null;
        $this->_description = ($data->has('description')) ? $data->getString('description') : null;
        $this->_channelId = ($data->has('channelId')) ? $data->getString('channelId') : null;
        $this->_entryList = ($data->has('entryList')) ? $data->get('entryList') : null;
    }

    /**
     * @return string
     */
    public function getName() {
        if (null === $this->_name) {
            $this->_load();
        }
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getDescription() {
        if (null === $this->_description) {
            $this->_load();
        }
        return $this->_description;
    }

    /**
     * @return string
     */
    public function getChannelId() {
        if (null === $this->_channelId) {
            $this->_load();
        }
        return $this->_channelId;
    }

    public function getEntryList() {
        if (null === $this->_entryList) {
            // todo: load over API
            $entryList = [];
            for ($i = 0; $i < 3; $i++) {
                $entryList[] = ['id' => 'id' . $i, 'data' => 'Data-' . $i, 'createStamp' => time()];
            }
            // //////////////////////////////////////
            $this->_entryList = new EntryList($entryList);
        }

        return $this->_entryList;
    }

    public function delete() {
        // todo: add delete
    }

    protected function _load() {
        // todo: get feed infos over API
        $data = new Params([
            'name'        => 'Feed123',
            'description' => 'description123',
            'channelId'   => 'channelId-123',
            'createStamp' => time(),
        ]);
        // //////////////////////////////////////

        $this->_name = $data->getString('name');
        $this->_description = $data->getString('description');
        $this->_channelId = $data->getString('channelId');
        $this->_createStamp = $data->getInt('createStamp');
    }
}
