<?php

namespace Feedlabs\Feedify;

use Feedlabs\Feedify\Exception\RequestException;

/**
 * Class Request
 * @package Feedlabs\Feedify
 */
class Request {

    CONST METHOD_GET = 1;
    CONST METHOD_POST = 2;
    CONST METHOD_PUT = 3;
    CONST METHOD_DELETE = 4;
    CONST API_URL = 'http://www.feed.dev:10111';

    /** @var string */
    protected $_apiId;

    /** @var string */
    protected $_apiToken;

    /**
     * @param string $apiId
     * @param string $apiToken
     */
    public function __construct($apiId, $apiToken) {
        $this->_apiId = $apiId;
        $this->_apiToken = $apiToken;
    }

    /**
     * @param string $path
     * @return array
     */
    public function get($path) {
        return Helper::decode($this->_send(self::METHOD_GET, $path));
    }

    /**
     * @param string $path
     * @param array  $data
     * @return array
     */
    public function post($path, $data) {
        return Helper::decode($this->_send(self::METHOD_POST, $path, $data));
    }

    /**
     * @param string $path
     * @param array  $data
     * @return array
     */
    public function put($path, $data) {
         return Helper::decode($this->_send(self::METHOD_PUT, $path, $data));
     }

    /**
     * @param $path
     * @return array
     */
    public function delete($path) {
        return Helper::decode($this->_send(self::METHOD_DELETE, $path));
    }

    /**
     * @return string
     */
    public function getApiId() {
        return $this->_apiId;
    }

    /**
     * @return string
     */
    public function getApiToken() {
        return $this->_apiToken;
    }

    /**
     * @param int        $method
     * @param string     $path
     * @param array|null $data
     * @return string
     * @throws RequestException
     */
    protected function _send($method, $path, $data = null) {
        $path = (string) $path;
        $url = self::API_URL . '/v' . Client::API_VERSION . $path;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

        $header = array();
        $header[] = 'Content-type:application/json';

        switch ($method) {
            case self::METHOD_GET:
                break;
            case self::METHOD_POST:
                $sendData = Helper::encode($data);
                $header[] = 'Content-Length: ' . strlen($sendData);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sendData);
                break;
            case self::METHOD_PUT:
                $sendData = Helper::encode($data);
                $header[] = 'Content-Length: ' . strlen($sendData);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sendData);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case self::METHOD_DELETE:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                throw new RequestException('Unknown request method `' . $method . '`.');
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $url);

        $curlError = null;
        $content = curl_exec($ch);
        if ($content === false) {
            $curlError = 'Curl error: `' . curl_error($ch) . '` ';
        }

        $info = curl_getinfo($ch);
        if ((int) $info['http_code'] !== 200) {
            $curlError .= 'HTTP Code: `' . $info['http_code'] . '`';
        }

        curl_close($ch);
        if ($curlError) {
            $curlError = 'Fetching contents from `' . $url . '` failed: `' . $curlError;
            throw new RequestException($curlError);
        }
        return $content;
    }
}
