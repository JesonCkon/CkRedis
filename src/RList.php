<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03.
 */
namespace CkRedis;

class RList extends AbstractApi
{
    use Common;
    public $queue_name = '';
    public $queue_pop_name = '';
    public $queue_data_type = 'json';
    public $queue_data_type_list = array('json', 'serialize');
    public $key_arr = array(
        'blpop'      => 'BLPOP %s %d',
        'brpop'      => 'BRPOP %s %d',
        'rpoplpush' => 'RPOPLPUSH %s %s', //阻塞安全队列
        //LINDEX key index
        'lindex'     => 'LINDEX %s %d',
        'linsert'    => 'LINSERT %s %s "%s" "%s"',
        'llen'       => 'LLEN %s',
        'lpop'       => 'LPOP %s',
        'lpush'      => 'LPUSH %s %s',
    );

    public function setQueueName($name = '')
    {
        if (!empty($name)) {
            $this->queue_name = $name;
            $this->queue_pop_name = $name."_pop_list";
            return true;
        }

        return false;
    }

    public function setQueueDataType($type = 'json')
    {
        if (!in_array($type, $this->queue_data_type_list)) {
            return false;
        }
        $this->queue_data_type = $type;

        return true;
    }

    public function pushQueue($val)
    {
        if (empty($val)) {
            return false;
        }
        $val = $this->queueDataFormat($val);
        if($val!=false){
            return $this->lpush($this->queue_name, $val);
        }else{
            return false;
        }
    }

    public function queueDataFormat($data)
    {
        if (is_string($data)) {
            return $data;
        }
        if($this->queue_data_type == 'json'){
            return json_encode($data);
        }
        if($this->queue_data_type == 'serialize'){
            return serialize($data);
        }
        return false;
    }

    public function popQueue($is_safes = true)
    {
        if($is_safes == false){
            return $this->lpop();
        }else{
            $this->rpoplpush($this->queue_name,$this->queue_pop_name);
            if($this->llen($this->queue_pop_name)>0){
                return $this->lpop($this->queue_pop_name);
            }
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
