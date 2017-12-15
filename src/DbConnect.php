<?php
namespace engldom;

class DbConnect
{
    protected static $connect = [
        'dsn' => 'mysql:host=127.0.0.1;dbname=message3',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ];

    /**
     * @return array
     */
    public static function getConnect()
    {
        return static::$connect;
    }


}