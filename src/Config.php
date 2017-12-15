<?php

namespace engldom;

use engldom\Responce\ResponceOption;

class Config
{

    /**
     * @var array
     */
    protected static $config = [
        'responceType' => ResponceOption::JSON_RESPONCE,
        'source'       => 'mysql'
    ];

    /**
     * @return string
     */
    public static function getResponceType() : string
    {
        return static::$config['responceType'];
    }

    /**
     * @return string
     */
    public static function getSource() : string
    {
        return static::$config['source'];
    }

    /**
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        foreach ($config as $configKey => $configValue){
            if(key_exists($configKey, static::$config)){
                static::$config[$configKey] = $configValue;
            }
        }
    }

    /**
     * @return array
     */
    public static function getConfig()
    {
        return static::$config;
    }


}

