<?php

namespace haniokasai\threadtest\threadtest;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Thread;

class threadtest extends PluginBase implements Listener
{
    public function onEnable(){
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
        Server::getInstance()->getLogger()->notice("Starting PocketMine-Thread");
        $job1 = new thread_ex1("Hello");
        $job1->start();
        for ($count = 0; $count < 10; $count++){
            $job2 = new thread_ex2();
            $job2->start();
        }

        for ($count = 0; $count < 10; $count++){
            $job3 = new thread_ex3();
            $job3->start();
        }
    }
}

class thread_ex1 extends Thread
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function run()
    {
        Server::getInstance()->getLogger()->notice($this->data);
    }
}

class thread_ex2 extends Thread
{
    public function __construct()
    {
    }

    public function run()
    {
        sleep(1);
        Server::getInstance()->getLogger()->notice(time());
    }
}

class thread_ex3 extends Thread
{
    public function __construct()
    {
    }

    public function run()
    {
        $bool = true;
        $i=0;
        $time = time();
        while ($bool){
            ++$i;
            if(time()-$time>=30){

            }
        }
    }
}