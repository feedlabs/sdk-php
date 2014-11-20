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

    /** @var string */
    protected $_data;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        parent::__construct($data);
        $this->_data = ($data->has('data')) ? $data->getString('data') : null;
    }

    /**
     * @return string
     */
    public function getData() {
        if (null === $this->_data) {
            $this->_load();
        }
        return $this->_data;
    }

    protected function _load() {
        // todo: get feed infos over API
        $data = new Params([
            'data'        => 'description123',
            'createStamp' => time(),
        ]);
        // //////////////////////////////////////

        $this->_data = $data->getString('data');
        $this->_createStamp = $data->getInt('createStamp');
    }
}
