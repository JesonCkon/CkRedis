<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/18
 * Time: 11:03
 */

namespace CkRedis;

class Handler
{
    const ED = "\r\n";
    protected $host;
    protected $port;
    protected $sock;
    protected $config;
    protected $timeout = 1;
    protected $read_length = 1024;
    public $debug_info = array();
    public $isConnect = false;
    public function __construct()
    {
        $this->_initialization(func_num_args(), func_get_args());
        $this->isConnect = $this->_connect();
    }
    private function _initialization($num_args, $args)
    {
        if ($num_args == 1 && is_array($args)) {
            $t = $args[0];
            $this->host = isset($t['host']) ? (string) $t['host'] : null;
            $this->port = isset($t['port']) ? (string) $t['port'] : null;
            isset($t['timeout']) and $this->timeout = (string) $t['timeout'];
            $this->config = $args;
        } elseif ($num_args >= 2) {
            $this->host = isset($args[0]) ? (string) $args[0] : null;
            $this->port = isset($args[1]) ? (string) $args[1] : null;
            isset($args[2]) and $this->timeout = (string) $args[2];
            $this->config = $args;
        }
    }
    private function _connect()
    {
        $this->sock = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
        if ($this->sock == false) {
            return false;
        }

        return true;
    }
    private function _write($string = '')
    {
        if ($this->sock) {
            fwrite($this->sock, $string);

            return true;
        }

        return false;
    }
    private function _read($length = 0)
    {
        $length = $length > 0 ? $length : $this->read_length;
        if ($length > 0) {
            if ($s = fgets($this->sock, $length)) {
                return $s;
            }
        }
        if ($s = fgets($this->sock)) {
            return $s;
        }
    }
    public function runCommand($str, $length = 0)
    {
        $this->_write($str);

        return $this->_getValue($length);
    }
    private function _getValue($length = 0)
    {
        $reply = null;
        $temp_str = $this->_read($length);
        $reply = trim($temp_str);
        if (isset($reply[0]) && $reply[0] == '*') {
            $count = substr($reply, 1)-1;
            $return_val_str = [];
            for($i=0;$i<=$count;$i++){
                $return_key_str = $this->_read($length);
                if(isset($return_key_str[0]) && $return_key_str[0] == '$'){
                    $val_len = substr($return_key_str, 1);
                    $val =  trim($this->_read($length));
                    if(strlen($val) == $val_len){
                        $return_val_str[] = $val;
                    }
                    //$return_val_str[] = $val;
                }
            }
            $reply = $return_val_str;
            return $reply;
        }
        if (isset($reply[0]) && $reply[0] == '$') {

            $reply_len = substr($reply, 1);
            if(abs($reply_len) != $reply_len && substr(strval($reply_len), 0, 1) == "-"){
                $this->debug_info['error'] = -1;
                $this->debug_info['return'] = $reply;
                $this->debug_info['error_message'] = 'key don\'t exists';
                return false;
            }
            $reply = trim($this->_read($length));
            if ($reply_len == strlen($reply)) {
                return $reply;
            } else {
                #TODO
            }
        }
        if (isset($reply[0]) && $reply[0] == '+') {
            $reply = substr($reply, 1);
            if ($reply == 'OK') {
                return true;
            }else{
                return $reply;
            }
        }
        if (isset($reply[0]) && $reply[0] == ':') {
            $reply = substr($reply, 1);

            return $reply;
        }
        if (isset($reply[0]) && $reply[0] == '-') {
            $reply = substr($reply, 1);

            return $reply;
        }
    }
    private function _disconnect()
    {
        if ($this->sock) {
            fclose($this->sock);
        }
    }
    public function __destruct()
    {
        $this->_disconnect();
    }
}
