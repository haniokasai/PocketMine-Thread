<?php

namespace haniokasai;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\AsyncTask;
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

        //https://github.com/pmmp/PocketMine-MP/blob/master/src/pocketmine/scheduler/AsyncTask.php
        $job3 = new thread_ex3();
        $job3->run();

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
        echo $this->data;
       Server::getInstance()->getLogger()->notice($this->data);// not working!!
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
        echo time();
    }
}

class thread_ex3 extends AsyncTask
{

    public function onRun()
    {
        $bool = true;
        $i=0;
        $time = time();
        /*while ($bool){
            ++$i;
            if(time()-$time>=15){
                echo $i;
                $bool =false;
            }
        }*/
        echo $i;
    }

    public function onCompletion(Server $server)
    {
        echo 2;
        $server->getLogger()->notice("comp job3!");
    }
}