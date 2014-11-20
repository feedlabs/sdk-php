<?php

namespace Feedlabs\Feedify\Resource;

/**
 * Class AbstractList
 * @package Feedlabs\Feedify\Resource
 */
abstract class AbstractList implements \Iterator, \Countable {

    /** @var array */
    private $_itemListRaw;

    /** @var array */
    private $_itemList;

    /** @var array */
    private $_iteratorItems;

    /** @var int */
    private $_iteratorPosition = 0;

    /**
     * @param array $itemList
     */
    public function __construct(array $itemList = null) {
        $this->_itemListRaw = (array) $itemList;
    }

    /**
     * @return array
     */
    public function getItems() {
        if (!$this->_itemList) {
            $itemList = array();
            foreach ($this->_itemListRaw as $item) {
                $itemList[] = $this->_processItem($item);
            }
            $this->_itemList = $itemList;
        }
        return $this->_itemList;
    }

    /**
     * @return int
     */
    public function getCount() {
        return count($this->getItems());
    }

    /**
     * @return bool
     */
    public function isEmpty() {
        return 0 === $this->getCount();
    }

    /**
     * @param array $item
     * @return AbstractElement|array
     */
    protected function _processItem($item) {
        return $item;
    }

    function rewind() {
        $this->_iteratorItems = $this->getItems();
        $this->_iteratorPosition = 0;
    }

    function current() {
        return $this->_iteratorItems[$this->_iteratorPosition];
    }

    function key() {
        return $this->_iteratorPosition;
    }

    function next() {
        ++$this->_iteratorPosition;
    }

    function valid() {
        return isset($this->_iteratorItems[$this->_iteratorPosition]);
    }

    public function count() {
        return $this->getCount();
    }
}
