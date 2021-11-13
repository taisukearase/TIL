<?php

class Queue
{
    public array $queue;

    public function __construct()
    {
        $this->queue = [];
    }

    public function enQueue($data)
    {
        $this->queue[] = $data;
    }

    public function deQueue()
    {
        if ($this->queue) {
            return array_shift($this->queue);
        }
    }
}

$queue = new Queue();
$queue->enQueue(1);
$queue->enQueue(2);
$queue->enQueue(3);
$res = $queue->deQueue();

echo $res;
var_dump($queue->queue);

function reverse(array $queue)
{
    $newQueue = [];

    while ($queue) {
        $newQueue[] = array_pop($queue);
    }

    return $newQueue;
}

$queue = range(1, 10);
$result = reverse($queue);

echo $result === array_reverse($queue) ? '成功' : '失敗';
