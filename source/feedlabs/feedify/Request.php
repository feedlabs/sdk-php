<?php

namespace feedlabs\feedify;

class Request {

    /** @var string */
    protected $_apiId;

    /** @var string */
    protected $_apiToken;

    public function __construct($apiId, $apiToken) {
        $this->_apiId = $apiId;
        $this->_apiToken = $apiToken;
    }

    public function getContentFromUrl($url) {
        $url = (string) $url;
        return $this->_sendRequest($url);
    }

    public function post($url, $data) {
        return $this->_sendRequest($url, $data, true);
    }

    protected function _sendRequest($url, $params = null, $methodPost = null, $timeout = null) {

        // how to do a put
        // http://stackoverflow.com/questions/3958226/using-put-method-with-php-curl-library

        // how to do a delete
        // http://php.net/manual/en/function.curl-setopt.php#97206

        $url = (string) $url;
        $sendData = json_encode($params);
        $headers = array(
            'Content-type:application/json',
            'Content-Length: ' . strlen($sendData),
        );

        $curlConnection = curl_init();
        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curlConnection, CURLOPT_TIMEOUT, 10);
        curl_setopt($curlConnection, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($curlConnection, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlConnection, CURLOPT_POST, 1);
        curl_setopt($curlConnection, CURLOPT_URL, $url);
        curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $sendData);

        $curlError = null;
        $contents = curl_exec($curlConnection);
        if ($contents === false) {
            $curlError = 'Curl error: `' . curl_error($curlConnection) . '` ';
        }

        $info = curl_getinfo($curlConnection);
        if ((int) $info['http_code'] !== 200) {
            $curlError .= 'HTTP Code: `' . $info['http_code'] . '`';
        }

        curl_close($curlConnection);
        if ($curlError) {
            $curlError = 'Fetching contents from `' . $url . '` failed: `' . $curlError;
            throw new \Exception($curlError);
        }
        return $contents;
    }


    //    protected function _sendRequest($url, $params = null, $methodPost = null, $timeout = null) {
    //        $url = (string) $url;
    //        if (!empty($params)) {
    //            $sendData = json_encode($params);
    //        }
    //        if (null === $timeout) {
    //            $timeout = 10;
    //        }
    //        $timeout = (int) $timeout;
    //
    //        $curlConnection = curl_init();
    //        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, true);
    //        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, true);
    //        curl_setopt($curlConnection, CURLOPT_TIMEOUT, $timeout);
    //        curl_setopt($curlConnection, CURLOPT_USERAGENT, 'Mozilla/5.0 AppleWebKit');
    //        if ($methodPost) {
    //            curl_setopt($curlConnection, CURLOPT_POST, 1);
    //            if (!empty($sendData)) {
    //                curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $sendData);
    //            }
    //            //        } else {
    //            //            if (!empty($params)) {
    //            //                $url .= '?' . $params;
    //            //            }
    //        }
    //        curl_setopt($curlConnection, CURLOPT_URL, $url);
    //
    //        $curlError = null;
    //        $contents = curl_exec($curlConnection);
    //        if ($contents === false) {
    //            $curlError = 'Curl error: `' . curl_error($curlConnection) . '` ';
    //        }
    //
    //        $info = curl_getinfo($curlConnection);
    //        if ((int) $info['http_code'] !== 200) {
    //            $curlError .= 'HTTP Code: `' . $info['http_code'] . '`';
    //        }
    //
    //        curl_close($curlConnection);
    //        if ($curlError) {
    //            $curlError = 'Fetching contents from `' . $url . '` failed: `' . $curlError;
    //            throw new \Exception($curlError);
    //        }
    //        return $contents;
    //    }

    //    protected function _sendRequest($url, array $content = null) {
    //        $url = (string) $url;
    //        $sendData = json_encode($content);
    //        $headers = array(
    //            'Content-type:application/json',
    //            'Content-Length: ' . strlen($sendData),
    //        );
    //
    //        $curlConnection = curl_init();
    //        curl_setopt($curlConnection, CURLOPT_RETURNTRANSFER, true);
    //        curl_setopt($curlConnection, CURLOPT_FOLLOWLOCATION, true);
    //        curl_setopt($curlConnection, CURLOPT_TIMEOUT, 10);
    //        curl_setopt($curlConnection, CURLOPT_USERAGENT, 'Mozilla/5.0');
    //        curl_setopt($curlConnection, CURLOPT_HTTPHEADER, $headers);
    //        curl_setopt($curlConnection, CURLOPT_POST, 1);
    //        curl_setopt($curlConnection, CURLOPT_URL, $url);
    //        curl_setopt($curlConnection, CURLOPT_POSTFIELDS, $sendData);
    //
    //        $curlError = null;
    //        $returnContent = curl_exec($curlConnection);
    //        if ($returnContent === false) {
    //            $curlError = 'Curl error: `' . curl_error($curlConnection) . '` ';
    //        }
    //
    //        $info = curl_getinfo($curlConnection);
    //        if ((int) $info['http_code'] !== 200) {
    //            $curlError .= 'HTTP Code: `' . $info['http_code'] . '`';
    //        }
    //
    //        curl_close($curlConnection);
    //        if ($curlError) {
    //            $curlError = 'Fetching contents from `' . $url . '` failed: `' . $curlError;
    //            throw new \Exception($curlError);
    //        }
    //    }
}
