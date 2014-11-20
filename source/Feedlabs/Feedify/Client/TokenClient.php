<?php

namespace Feedlabs\Feedify\Client;

use Feedlabs\Feedify\Params;
use Feedlabs\Feedify\Resource\Token;
use Feedlabs\Feedify\Resource\TokenList;

/**
 * Class TokenClient
 * @package Feedlabs\Feedify\Client
 */
class TokenClient {

    /**
     * @return TokenList
     */
    public function getList() {
        // todo: load over API

        $tokenList = [];
        for ($i = 0; $i < 5; $i++) {
            $tokenList[] = ['token' => 'token' . $i, 'name' => 'Name-' . $i, 'createStamp' => time()];
        }

        return new TokenList($tokenList);
    }

    /**
     * @param string $token
     * @return Token
     */
    public function get($token) {
        $token = (string) $token;
        // todo: load over API
        $data = ['token' => $token, 'name' => 'Namedjgsfjhsdgfhjsfgdshj', 'createStamp' => time()];

        return new Token(new Params($data));
    }

    public function create($name) {
        // todo: load over API
        $data = ['token' => 'tokenHASH', 'name' => $name, 'createStamp' => time()];

        return new Token(new Params($data));
    }

    public function delete($token) {
        // todo: add
    }
}
