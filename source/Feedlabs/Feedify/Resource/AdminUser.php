<?php

namespace Feedlabs\Feedify\Resource;

use Feedlabs\Feedify\Params;

/**
 * Class AdminUser
 * @package Feedlabs\Feedify\Resource
 */
class AdminUser extends AbstractElement {

    /** @var string|null */
    protected $_email;

    /** @var array[]|null */
    protected $_roleList;

    /**
     * @param Params $data
     */
    public function __construct(Params $data) {
        parent::__construct($data);
        $this->_email = ($data->has('email')) ? $data->getString('email') : null;
        $this->_roleList = ($data->has('roleList')) ? $data->getArray('roleList') : null;
    }

    /**
     * @return string
     */
    public function getEmail() {
        if (null === $this->_email) {
            $this->_load();
        }
        return $this->_email;
    }

    /**
     * @return array[]
     */
    public function getRoleLIst() {
        if (null === $this->_roleList) {
            $this->_load();
        }
        return $this->_roleList;
    }

    public function delete() {
        // todo: add delete
    }

    protected function _load() {
        // todo: get userAdmin infos over API
        $data = new Params([
            'email'       => 'test@example.com',
            'roleList'    => [['id' => 1, 'name' => 'superAdmin'], ['id' => 2, 'name' => 'admin']],
            'createStamp' => time(),
        ]);
        // //////////////////////////////////////

        $this->_email = $data->getString('email');
        $this->_roleList = $data->getArray('roleList');
        $this->_createStamp = $data->getInt('createStamp');
    }
}
