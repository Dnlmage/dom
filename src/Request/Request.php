<?php

namespace engldom\Request;

use engldom\Common\RequestInterface;
use engldom\Exception\UnsupportedMethodException;
use engldom\Request\RequestOption;

/**
 * Class Request
 * @package engldom\Request
 */
class Request implements RequestInterface
{

    /**
     * @var array
     */
    protected $allowRequestMethod = [RequestOption::GET_REQUEST, RequestOption::POST_REQUEST];

    /**
     * @return mixed
     * @throws UnsupportedMethodException
     */
    public function getRequestMethod()
    {
        if (in_array($_SERVER['REQUEST_METHOD'], $this->allowRequestMethod)) {
            return $_SERVER['REQUEST_METHOD'];
        }

        throw new UnsupportedMethodException('Unsupported method');
    }

    /**
     * @param $name
     * @return string
     */
    public static function get(string $name)
    {
        return (isset($_GET[$name])) ? $_GET[$name] : '';
    }

    /**
     * @param $name
     * @return string
     */
    public static function post(string $name)
    {
        return (isset($_POST[$name])) ? $_POST[$name] : '';
    }
}
