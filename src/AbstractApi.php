<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03
 */

namespace CkRedis;

abstract class AbstractApi
{
    public function __construct($obj = null)
    {
        if (!empty($obj)) {
            $this->di = $obj;
            //var_dump($obj);
        }
    }

    public function __call($name = null, $args = null)
    {
        if (in_array(strtolower($name), array_keys($this->key_arr))) {

            self::argsFilter($args);
            $str = vsprintf($this->key_arr[ $name ], $args) . Handler::ED;

            return $this->handler->runCommand($str);

        }
    }

    public function register($obj, $key, $service_name)
    {
        $obj->$key = function () use ($obj, $service_name) {
            return new $service_name($obj);
        };
    }

    public function __get($name = '')
    {
        if (isset($this->di->$name)) {
            return $this->di->$name;
        }
    }

    abstract public function del();
}
