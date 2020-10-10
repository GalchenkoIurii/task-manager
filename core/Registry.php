<?php
/**
 * Created by PhpStorm.
 * User: Iurii
 * Date: 10.10.2020
 * Time: 14:27
 */

namespace core;


class Registry
{
    private static $instance;

    private static $properties = [];

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperty($name)
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }

    public function getProperties()
    {
        return self::$properties;
    }
}