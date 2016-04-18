<?php

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
