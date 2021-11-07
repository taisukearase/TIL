<?php

class Node
{
    public function __construct(public $data, public ?Node $next = null, public ?Node $prev = null)
    {
    }
}

class DoublyLinkedList
{
    public ?Node $head = null;

    public function __construct()
    {
    }

    public function append($data)
    {
        $newNode = new Node($data);

        if ($this->head === null) {
            $this->head = $newNode;
            return;
        }

        $currNode = $this->head;
        $currNode->next = $newNode;
        $newNode->prev = $currNode;
    }

    public function insert($data)
    {
        $newNode = new Node($data);

        if ($this->head === null) {
            $this->head = $newNode;
            return;
        }

        $this->head->prev = $newNode;
        $newNode->next = $this->head;
        $this->head = $newNode;
    }

    public function print()
    {
        $currNode = $this->head;

        while ($currNode !== null) {
            echo $currNode->data;
            $currNode = $currNode->next;
        }
    }
}

$list = new DoublyLinkedList();
$list->append(1);
$list->insert(3);
$list->print();
