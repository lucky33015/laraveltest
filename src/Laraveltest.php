<?php


namespace skypower\laraveltest;


use Illuminate\Config\Repository;

class Laraveltest
{
    public $config;

    /**
     * Laraveltest constructor.
     * @param mixed $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    //测试方法
    public function test(){
        return $this->config;
    }
}
