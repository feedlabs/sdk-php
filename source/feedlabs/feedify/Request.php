<?php

namespace feedlabs\feedify;

use feedlabs\feedify\Exception\RequestException;

/**
 * Class Request
 * @package feedlabs\feedify
 */
class Request {

    CONST METHOD_GET = 1;
    CONST METHOD_POST = 2;
    CONST METHOD_PUT = 3;
    CONST METHOD_DELETE = 4;

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
     * @param string $url
     * @return array
     */
    public function get($url) {
        return Helper::decode($this->_send(self::METHOD_GET, $url));
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     */
    public function post($url, $data) {
        return Helper::decode($this->_send(self::METHOD_POST, $url, $data));
    }

    public function put($url, $data) {
        // http://stackoverflow.com/questions/3958226/using-put-method-with-php-curl-library
    }

    public function delete($url) {
        // http://php.net/manual/en/function.curl-setopt.php#97206
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
     * @param string     $url
     * @param array|null $data
     * @return string
     * @throws RequestException
     */
    protected function _send($method, $url, $data = null) {
        $url = (string) $url;
        $curlConnection = curl_init();
        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curlConnection, CURLOPT_TIMEOUT, 10);
        curl_setopt($curlConnection, CURLOPT_USERAGENT, 'Mozilla/5.0');

        $header = array();
        $header[] = 'Content-type:application/json';

        switch ($method) {
            case self::METHOD_GET:
                //do stuff
                break;
            case self::METHOD_POST:
                $sendData = Helper::encode($data);
                $header[] = 'Content-Length: ' . strlen($sendData);
                curl_setopt($curlConnection, CURLOPT_POST, 1);
                curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $sendData);
                break;
            case self::METHOD_PUT:
                //do stuff
                break;
            case self::METHOD_DELETE:
                //do stuff
                break;
            default:
                throw new RequestException('Unknown request method `' . $method . '`.');
        }

        curl_setopt($curlConnection, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curlConnection, CURLOPT_URL, $url);

        $curlError = null;
        $content = curl_exec($curlConnection);
        if ($content === false) {
            $curlError = 'Curl error: `' . curl_error($curlConnection) . '` ';
        }

        $info = curl_getinfo($curlConnection);
        if ((int) $info['http_code'] !== 200) {
            $curlError .= 'HTTP Code: `' . $info['http_code'] . '`';
        }

        curl_close($curlConnection);
        if ($curlError) {
            $curlError = 'Fetching contents from `' . $url . '` failed: `' . $curlError;
            throw new RequestException($curlError);
        }
        return $content;
    }
}
