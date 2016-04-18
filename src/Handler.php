<?php
/**
 *
 */
class Handler
{
    const ED = "\r\n";
    protected $host;
    protected $port;
    protected $sock;
    protected $config;
    protected $timeout = 1;
    protected $read_length = 1024;
    public function __construct()
    {
        $this->_initialization(func_num_args(), func_get_args());
        $this->_connect();
    }
    private function _initialization($num_args, $args)
    {

    }
    private function _connect()
    {
        $this->sock = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
        if ($this->sock == false) {
            #TODO
        #echo "$errstr ($errno)<br />\n";
        }

        return true;
    }
}
