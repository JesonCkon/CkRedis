<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03
 */

namespace CkRedis;

class RList extends AbstractApi
{
    use Common;
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
