<?php

namespace feedify;

class PhpClient {

    /**
     * @param string     $url
     * @param array|null $content
     * @throws \Exception
     * @return string
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
