<?php

namespace feedlabs\feedify;

class Resource_Feed extends Resource_Abstract {

    /** @var string */
    protected $_id;

    /** @var array|null */
    protected $_data;

    /**
     * @param string $id
     */
    public function __construct($id) {
        $this->_id = (string) $id;
        $this->_load();
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * @return array|null
     */
    public function getData() {
        return $this->_data;
    }

    public function getEntryList() {
        $entryList = array();
        foreach ($this->_loadEntryList() as $entryId) {
            $entryList[] = new Resource_Entry($entryId);
        }
    }

    public function delete() {
    }

    protected function _loadEntryList() {
        // get connector
        // load data from url "feed.dev:10111/v1/feed/111/entry"
        // convert json to array // Helper::decode($data);
        return array('1', '2', '3');
    }

    /**
     * @param array $data
     */
    protected function _setData(array $data) {
        $this->_data = (array) $data;
    }

    protected function _load() {
        // get connector
        $connector = Client::getRequest();
        // load data from url "feed.dev:10111/v1/feed/111"
        $dataJson = $connector->getContentFromUrl('http://feed.dev:10111/v1/feed/' . $this->getId());
        // convert json to array // Helper::decode($data);
        $data = Helper::decode($dataJson);
        // set data
        $this->_setData($data);
    }
}
