<?php

namespace engldom\Controller;

use engldom\Common\ExecutableInterface;
use engldom\Common\ResponceInterface;
use engldom\Controller;
use engldom\Request\RequestOption;
use engldom\Responce\ResponceOption;
use engldom\Responce\JsonResponce;
use engldom\Config;

/**
 * Class BaseController
 * @package engldom\Controller
 */
abstract class BaseController
{

    /**
     * @param string $type
     * @return ExecutableInterface
     */
    public static function initial(string $type): ExecutableInterface
    {
        if ($type === RequestOption::POST_REQUEST) {
            return new PostController();
        }

        if ($type === RequestOption::GET_REQUEST) {
            return new GetController();
        }

        throw new \InvalidArgumentException('Unknown method given');
    }

    /**
     * @return ResponceInterface
     */
    public static function getResponce(): ResponceInterface
    {
        if (Config::getResponceType() === ResponceOption::JSON_RESPONCE) {
            return new JsonResponce();
        }

        throw new \InvalidArgumentException('Unknown responce format given');
    }
}
