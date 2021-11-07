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

        $lastNode = $this->head;

        while ($lastNode->next) {
            $lastNode = $lastNode->next;
        }

        $newNode->prev = $lastNode;
        $lastNode->next = $newNode;
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

    public function remove($data)
    {
        $currNode = $this->head;

        if ($currNode?->data === $data) {
            if ($currNode->next === null) {
                $this->head = null;
                return;
            }

            $nextNode = $currNode->next;
            $nextNode->prev = null;
            $this->head = $nextNode;
            return;
        }

        while ($currNode !== null && $currNode->data !== $data) {
            $currNode = $currNode->next;
        }

        if ($currNode === null) {
            return;
        }
        
        $prevNode = $currNode->prev;
        $nextNode = $currNode->next;
        $prevNode->next = $nextNode;
        
        if ($nextNode === null) {
            return;
        }

        $nextNode->prev = $prevNode;
    }
}

$list = new DoublyLinkedList();
$list->append(2);
$list->append(3);
$list->append(4);
$list->append(5);
$list->insert(1);
$list->remove(4);
$list->print();
