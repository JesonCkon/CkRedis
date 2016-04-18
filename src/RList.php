<?php

namespace CkRedis;

class RList extends AbstractApi
{
    public function get($key = '')
    {
        $str = "GET {$key}".Handler::ED;
        var_dump($this->di->handler);
    }
    public function set($key = '', $value = '')
    {
    }
    public function exists($key = '')
    {
    }
    public function del($key='')
    {
      # code...
    }
}
