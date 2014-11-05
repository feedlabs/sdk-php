<?php

namespace Feedlabs\Feedify;

use Feedlabs\Feedify\Exception\ParamsException;

/**
 * Class Params
 * @package Feedlabs\Feedify
 */
class Params {

    private $_params;

    /**
     * @param array|null $params
     */
    public function __construct(array $params = null) {
        $this->_params = $params ?: array();
    }

    /**
     * @param string     $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get($key, $default = null) {
        return $this->_get($key, $default);
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value) {
        $this->_params[$key] = $value;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key) {
        return array_key_exists($key, $this->_params) && null !== $this->_params[$key];
    }

    /**
     * @param string      $key
     * @param string|null $default
     * @return float
     */
    public function getFloat($key, $default = null) {
        $param = $this->_get($key, $default);
        return $this->_getFloat($param);
    }

    /**
     * @param string      $key
     * @param string|null $default
     * @return string
     */
    public function getString($key, $default = null) {
        $param = $this->_get($key, $default);
        return $this->_getString($param);
    }

    /**
     * @param string      $key
     * @param string|null $default
     * @return int
     */
    public function getInt($key, $default = null) {
        $param = $this->_get($key, $default);
        return $this->_getInt($param);
    }

    /**
     * @param string $key
     * @param array  $default
     * @return array
     * @throws ParamsException
     */
    public function getArray($key, array $default = null) {
        $param = $this->_get($key, $default);
        if (!is_array($param)) {
            throw new ParamsException('Not an Array');
        }
        return (array) $param;
    }

    /**
     * @param string  $key
     * @param boolean $default
     * @return boolean
     * @throws ParamsException
     */
    public function getBoolean($key, $default = null) {
        $param = $this->_get($key, $default);
        if (1 === $param || '1' === $param || 'true' === $param) {
            $param = true;
        }
        if (0 === $param || '0' === $param || 'false' === $param) {
            $param = false;
        }
        if (!is_bool($param)) {
            throw new ParamsException('Not a boolean');
        }
        return (boolean) $param;
    }

    /**
     * @param string $key
     */
    public function remove($key) {
        unset($this->_params[$key]);
    }

    /**
     * @param string $key
     * @param mixed  $default
     * @throws ParamsException
     * @return mixed
     */
    protected function _get($key, $default = null) {
        if (!$this->has($key) && $default === null) {
            throw new ParamsException("Param `$key` not set");
        }
        if (!$this->has($key) && $default !== null) {
            return $default;
        }
        return $this->_params[$key];
    }

    /**
     * @param mixed $param
     * @return float
     * @throws ParamsException
     */
    private function _getFloat($param) {
        if (is_float($param) || is_int($param)) {
            return (float) $param;
        }
        if (is_string($param)) {
            if (preg_match('/^-?(?:\\d++\\.?+\\d*+|\\.\\d++)$/', $param)) {
                return (float) $param;
            }
        }
        throw new ParamsException('Not a float');
    }

    /**
     * @param mixed $param
     * @return string
     * @throws ParamsException
     */
    private function _getString($param) {
        if (!is_string($param)) {
            throw new ParamsException('Not a String');
        }
        return (string) $param;
    }

    /**
     * @param mixed $param
     * @return int
     * @throws ParamsException
     */
    private function _getInt($param) {
        if (!ctype_digit($param) && !is_int($param)) {
            throw new ParamsException('Not an Integer');
        }
        return (int) $param;
    }
}
