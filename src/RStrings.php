<?php

namespace CkRedis;

class RStrings extends AbstractApi
{
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
        if (is_string($key)) {
          $command_str = "EXISTS {$key}".Handler::ED;
        }elseif (is_array($key)) {
          $key_str = '';
          $key_str = implode(" ",$key);
          $command_str = "EXISTS {$key_str}".Handler::ED;
        }
        return $this->handler->runCommand($command_str);
    }
    public function del($key = '')
    {
        # code...
    }
    public function getDebug()
    {
        return $this->handler->debug_info;
    }
}
