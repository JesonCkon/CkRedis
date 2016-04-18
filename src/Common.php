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
      $str = '';
      if (is_array($key)) {
        $str = implode(" ",$key);
      }else {
        $str = (string)$key;
      }
      return $str;
  }
}
