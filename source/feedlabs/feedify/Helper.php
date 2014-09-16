<?php

namespace feedlabs\feedify;

use feedlabs\feedify\Exception\HelperException;

/**
 * Class Helper
 * @package feedlabs\feedify
 */
class Helper {

    /**
     * @param mixed $value
     * @return string
     * @throws HelperException
     */
    public static function encode($value) {
        $value = json_encode($value, JSON_PRETTY_PRINT);
        if (json_last_error() > 0) {
            throw new HelperException('Cannot json_encode value `' . self::_varLine($value) . '`.');
        }
        return $value;
    }

    /**
     * @param $value
     * @return mixed
     * @throws HelperException
     */
    public static function decode($value) {
        $value = json_decode((string) $value, true);
        if (json_last_error() > 0) {
            throw new HelperException('Cannot json_decode value `' . $value . '`.');
        }
        return $value;
    }

    /**
     * @param mixed $expression
     * @return string
     */
    protected static function _varLine($expression) {
        $line = print_r($expression, true);
        $line = str_replace(PHP_EOL, ' ', $line);
        $line = trim($line);
        return $line;
    }
}
