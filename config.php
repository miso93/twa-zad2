<?php
/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 29.02.2016
 * Time: 11:57
 */

class Config {

    private static $config = [
        'mysql' => [
            'db_name' => 'twa-zad2',
            'user'    => 'root',
            'pass'    => ''
        ]
    ];

    public static function get($key)
    {
        list($first, $second) = explode('.', $key);

        if(isset(self::$config[$first][$second])){
            return self::$config[$first][$second];
        }
        return null;
    }
}