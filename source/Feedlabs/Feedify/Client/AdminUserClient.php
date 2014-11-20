<?php

namespace Feedlabs\Feedify\Client;

use Feedlabs\Feedify\Params;
use Feedlabs\Feedify\Resource\AdminUser;
use Feedlabs\Feedify\Resource\AdminUserList;

/**
 * Class AdminUserClient
 * @package Feedlabs\Feedify\Client
 */
class AdminUserClient {

    /**
     * @return AdminUserList
     */
    public function getList() {
        // todo: load over API
        $adminUserList = [];
        for ($i = 0; $i < 5; $i++) {
            $adminUserList[] = [
                'id'          => 'adminUserId-' . $i,
                'email'       => 'test' . $i . '@example.com',
                'roleList'    => [['id' => 1, 'name' => 'superAdmin']],
                'createStamp' => time(),
            ];
        }

        return new AdminUserList($adminUserList);
    }

    /**
     * @param string $adminUserId
     * @return AdminUser
     */
    public function get($adminUserId) {
        $adminUserId = (string) $adminUserId;
        // todo: load over API
        $data = [
            'id'          => $adminUserId,
            'email'       => 'test@example.com',
            'roleList'    => [['id' => 1, 'name' => 'superAdmin']],
            'createStamp' => time(),
        ];

        return new AdminUser(new Params($data));
    }

    /**
     * @param string     $email
     * @param array|null $roleList
     * @return AdminUser
     */
    public function create($email, array $roleList = null) {
        $email = (string) $email;
        $roleList = (array) $roleList;
        // todo: load over API
        $data = [
            'id'          => 'ID1234',
            'email'       => $email,
            'roleList'    => [['id' => 1, 'name' => 'superAdmin']],
            'createStamp' => time(),
        ];

        return new AdminUser(new Params($data));
    }

    /**
     * @param string     $adminUserId
     * @param string     $email
     * @param array|null $roleList
     * @return AdminUser
     */
    public function update($adminUserId, $email, array $roleList = null) {
        $adminUserId = (string) $adminUserId;
        $email = (string) $email;
        $roleList = (array) $roleList;
        // todo: load over API
        $data = [
            'id'          => 'ID1234',
            'email'       => $email,
            'roleList'    => [['id' => 1, 'name' => 'superAdmin']],
            'createStamp' => time(),
        ];

        return new AdminUser(new Params($data));
    }

    public function delete($adminUserId) {
        $adminUserId = (string) $adminUserId;
        // todo: load over API
        // todo: what to return???
    }
}
