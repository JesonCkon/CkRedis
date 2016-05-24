<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 21:03
 */

namespace CkRedis;


trait Common
{

    public static function createKeys($key = '')
    {
        $str = null;
        if (is_array($key)) {
            $str = implode(" ", $key);
        } else {
            $str = (string)$key;
        }

        return $str;
    }

    public static function argsFilter($args = null)
    {
        foreach ($args as $key => $val) {
            if (is_array($val)) {
                if (count($val) == count($val, COUNT_RECURSIVE)) {

                    $args[ $key ] = implode(' ', array_map(
                        function ($v, $k) { return '"' . $k . '" "' . $v . '"'; },
                        $val,
                        array_keys($val)
                    ));
                } else {
                    $args[ $key ] = implode(" ", $val);
                }
            }
        }

        return $args;
    }
}
