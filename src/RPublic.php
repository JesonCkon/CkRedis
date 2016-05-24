<?php

/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/5/24
 * Time: 21:50
 */
namespace CkRedis;

class RPublic extends AbstractApi
{
    use Common;
    public $key_arr = array(
        'type'      => 'TYPE "%s"',
    );
    function del()
    {
        // TODO: Implement del() method.
    }

    public function getDebug()
    {
        return $this->handler->debug_info;
    }
}
