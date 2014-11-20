<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Client;
use Feedlabs\Feedify\Params;

/**
 * Class Application
 * @package Feedlabs\Feedify\Resource
 */
class Application extends AbstractElement {

    /** @var string */
    protected $_name;

    /** @var string */
    protected $_description;

    /** @var FeedList */
    protected $_feedList;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        parent::__construct($data);
        $this->_name = ($data->has('name')) ? $data->getString('name') : null;
        $this->_description = ($data->has('description')) ? $data->getString('description') : null;
        $this->_feedList = ($data->has('feedList')) ? $data->get('feedList') : null;
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
     * @return string|null
     */
    public function getDescription() {
        if (null === $this->_description) {
            $this->_load();
        }
        return $this->_description;
    }

    public function getFeedList() {
        if (null === $this->_feedList) {
            // todo: load over API
            $feedList = [];
            for ($i = 0; $i < 3; $i++) {
                $feedList[] = [
                    'id'          => 'id' . $i,
                    'name'        => 'Name-' . $i,
                    'description' => 'description-' . $i,
                    'channel'     => 'channel' . $i,
                    'createStamp' => time(),
                ];
            }
            // //////////////////////////////////////
            $this->_feedList = new FeedList($feedList);
        }

        return $this->_feedList;
    }

    public function delete() {
        // todo: add delete
    }

    protected function _load() {
        // todo: get application infos over API
        $data = new Params([
            'name'        => 'Name-ABC123',
            'description' => 'description-ABC123',
            'createStamp' => time(),
        ]);
        // //////////////////////////////////////

        $this->_name = $data->getString('name');
        $this->_description = $data->getString('description');
        $this->_createStamp = $data->getInt('createStamp');
    }
}
