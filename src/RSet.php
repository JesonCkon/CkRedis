<?php

/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03
 */
namespace CkRedis;

class RSet extends AbstractApi
{
    use Common;
    public $queue_name = '';
    public $queue_pop_name = '';
    public $queue_data_type = 'json';
    public $queue_data_type_list = array('json', 'serialize');
    public $key_arr = array(
        'sadd'        => 'SADD %s "%s"',
        'scard'       => 'SCARD %s',
        'sdiff'       => 'SDIFF %s',
        'sdiffstore'  => 'SDIFFSTORE %s',
        'sinter'      => 'SINTER %s',
        'sinterstore' => 'SINTERSTORE %s',
        'sismember'   => 'SISMEMBER %s "%s"',
        'smembers'    => 'SMEMBERS %s',
        'smove'       => 'SMOVE %s %s "%s"',
        'spop'        => 'SPOP %s',
        'srandmember' => 'SRANDMEMBER %s %s',
        'srem'        => 'SREM %s "%s"',
        'sscan'       => 'SSCAN %s %s',
        'sunion'      => 'SUNION %s',
        'sunionstore' => 'SUNIONSTORE %s'
    );

    public function sdiff($key_lists = null)
    {
        if (empty($key_lists)) {
            return array();
        }
        $key_str = self::argsToString($key_lists);
        $str = vsprintf($this->key_arr[ __FUNCTION__ ], $key_str) . Handler::ED;

        return $this->handler->runCommand($str);
    }

    public function sunion($key_lists = null)
    {
        if (empty($key_lists)) {
            return array();
        }
        $key_str = self::argsToString($key_lists);
        $str = vsprintf($this->key_arr[ __FUNCTION__ ], $key_str) . Handler::ED;

        return $this->handler->runCommand($str);
    }
    public function sunionstore($key_lists = null)
    {
        if (empty($key_lists)) {
            return array();
        }
        $key_str = self::argsToString($key_lists);
        $str = vsprintf($this->key_arr[ __FUNCTION__ ], $key_str) . Handler::ED;

        return $this->handler->runCommand($str);
    }
    function del()
    {
        $argc_list =func_get_args();
        $key_lists = $argc_list[0];
        if (empty($key_lists)) {
            return array();
        }
        $key_str = self::argsToString($key_lists);
        $str = vsprintf('DEL %s', $key_str) . Handler::ED;

        return $this->handler->runCommand($str);
    }
}

?>
