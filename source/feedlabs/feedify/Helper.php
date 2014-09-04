<?php

namespace feedlabs\feedify;

class Helper {

    public static function encode($value) {
        $value = json_encode($value, JSON_PRETTY_PRINT);
        if (json_last_error() > 0) {
            throw new \Exception('Cannot json_encode value `' . self::_varLine($value) . '`.');
        }
        return $value;
    }

    public static function decode($value) {
        $value = json_decode((string) $value, true);
        if (json_last_error() > 0) {
            throw new \Exception('Cannot json_decode value `' . $value . '`.');
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
