<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03.
 */
namespace CkRedis;

class RStrings extends AbstractApi
{
    use Common;
    const IS_APPEND = 'IS_APPEND';
    const IS_DEFAULT = 'IS_DEFAULT';
    public function get($key = '')
    {
        $str = "GET {$key}".Handler::ED;

        return $this->handler->runCommand($str);
    }
    public function set($key = '', $value = '', $type = IS_DEFAULT)
    {
        if ($type == IS_APPEND) {
            $command_str = "APPEND {$key} {$value}".Handler::ED;
        } else {
            $command_str = "SET {$key} {$value}".Handler::ED;
        }

        return $this->handler->runCommand($command_str);
    }
    public function exists($key = '')
    {
        $key_str = Common::createKeys($key);
        $command_str = "EXISTS {$key_str}".Handler::ED;

        return $this->handler->runCommand($command_str);
    }
    public function del($key = '')
    {
        $key_str = Common::createKeys($key);
        $command_str = "DEL {$key_str}".Handler::ED;

        return $this->handler->runCommand($command_str);
    }
    public function getDebug()
    {
        return $this->handler->debug_info;
    }
}
