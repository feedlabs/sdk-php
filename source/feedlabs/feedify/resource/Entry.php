<?php

namespace feedlabs\feedify\Resource;

use feedlabs\feedify\Client;
use feedlabs\feedify\Helper;

/**
 * Class Entry
 * @package feedlabs\feedify\Resource
 */
class Entry extends AbstractResource {

    /** @var string */
    protected $_id;

    /** @var array|null */
    protected $_data;

    /**
     * @param string     $id
     * @param array|null $data
     */
    public function __construct($id, $data = null) {
        // todo move set id to abstract construct
        $this->_id = (string) $id;
        $this->_setData($data);
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
        if (null === $this->_data) {
            $this->_load();
        }
        return $this->_data;
    }

    /**
     * @param array $data
     */
    public function update(array $data) {
        // update data
        $this->_setData($data);
        // json encode data
        $sendData = Helper::encode($data);
        // get connector
        // send data to url "feed.dev:10111/v1/feed/111/entry/222"
    }

    public function delete() {
    }

    /**
     * @param array $data
     */
    protected function _setData(array $data = null) {
        $this->_data = $data;
    }

    protected function _load() {

        $connector = Client::getRequest();
        //        echo 'Entry:'.$connector->getTest();

        // get connector
        // load data from url "feed.dev:10111/v1/feed/111/entry/222"
        // convert json to array // Helper::decode($data);
        // set data
        $this->_setData(array('entryTest1' => 'ID: ' . $this->getId() . ' - test1', 'entryTest2' => 'ID: ' . $this->getId() . ' - test2'));
    }
}
