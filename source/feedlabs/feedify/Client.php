<?php

namespace feedlabs\feedify;

class Client {

    /** @var string */
    private static $_apiId;

    /** @var string */
    private static $_apiToken;

    /** @var Request */
    private static $_request;

    public function __construct($apiId, $apiToken) {
        self::$_apiId = $apiId;
        self::$_apiToken = $apiToken;
    }

    public function getFeed($id) {
        return new Resource_Feed($id);
    }

    public function createFeed(array $data) {
        return self::getRequest()->post('http://www.feed.dev:10111/v1/feed', $data);
    }

    public function getFeedList() {
        //        $listNew = array();
        //        $list = getClient("feedpages");
        //        foreach($list as $feedpage) {
        //            $listNew[] = new Resource_FeedPage($feedpage);
        //        }
        echo 'toll';
    }

    /**
     * @return Request
     */
    public static function getRequest() {
        if (!self::$_request) {
            self::$_request = new Request(self::$_apiId, self::$_apiToken);
        }
        return self::$_request;
    }

    /**
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     * old implementation. will be deleted when client is ready
     */
    public function send($url, array $content = null) {
        $url = (string) $url;
        $sendData = json_encode($content);
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
        $returnContent = curl_exec($curlConnection);
        if ($returnContent === false) {
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
    }
}
