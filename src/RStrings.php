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
    private $key_arr = array(
        'append'      => 'APPEND "%s" "%s"',
        'bitcount'    => 'BITCOUNT "%s" %d %d',
        'bitop'       => 'BITOP %s "%s" %s',
        'bitpos'      => 'BITPOS "%s" %d %d %d',
        'decr'        => 'DECR "%s"',
        'decrby'      => 'DECRBY "%s" %d',
        'get'         => 'GET "%s"',
        'getbit'      => 'GETBIT %s %d',
        'getrange'    => 'GETRANGE %s %d %d',
        'getset'      => 'GETSET %s "%s"',
        'incr'        => 'INCR "%s"',
        'incrby'      => 'INCRBY "%s" %d',
        'incrbyfloat' => 'INCRBYFLOAT "%s" %f',
        'mget'        => 'MGET "%s" %s',
        'mset'        => 'MSET %s',
        'msetnx'      => 'MSETNX %s',
        'psetex'      => 'PSETEX "%s" %d "%s"',
        'set'         => 'SET "%s" "%s"',
        'setbit'      => 'SETBIT "%s" %d %d',
        'setex'       => 'SETEX "%s" %d "%s"',
        'setnx'       => 'SETNX "%s" "%s"',
        'setrange'    => 'SETRANGE "%s" %d "%s"',
        'strlen'      => 'STRLEN "%s"',
    );

    public function __call($name = null, $args = null)
    {
        if (in_array(strtolower($name), array_keys($this->key_arr))) {
            $str = vsprintf($this->key_arr[ $name ], self::argsFilter($args)) . Handler::ED;

            return $this->handler->runCommand($str);
        }
    }

    function del()
    {
        // TODO: Implement del() method.
    }

    public function getDebug()
    {
        return $this->handler->debug_info;
    }
}
