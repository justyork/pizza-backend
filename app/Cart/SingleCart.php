<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 21.04.2020
 */

namespace App\Cart;


class SingleCart
{
    private static $instances = [];

    protected function __construct() { }
    protected function __clone() { }
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * Hook before instance
     */
    protected function beforeLoad() { }

    protected static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static;
        }
        $instance = self::$instances[$subclass];
        $instance->beforeLoad();
        return $instance;
    }
}
