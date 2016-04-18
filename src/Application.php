<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03
 */

namespace CkRedis;

class Application extends Container
{
    public $handler = null;
    public $service_list = array(
        'str' => RStrings::class,
        'list' => RList::class,
    );
    private function _registerService()
    {
        foreach ($this->service_list as $key => $service_name) {
            $this->_register(new $service_name(), $key, $service_name);
        }
    }
    private function _register($service_obj, $key, $service_name)
    {
        $service_obj->register($this, $key, $service_name);

        return $this;
    }
    public function __construct()
    {
        $args = func_get_args();
        $this->handler = new Handler($args[0]);
        $this->_registerService();
    }
}
