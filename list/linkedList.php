<?php

class Node
{
    public function __construct(public $data, public ?Node $next = null)
    {
    }
}

class LinkedList
{
    public function __construct(public ?Node $head = null)
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
        $lastNode->next = $newNode;
    }

    public function insert($data)
    {
        $newNode = new Node($data, $this->head);
        $this->head = $newNode;
    }

    public function remove($data)
    {
        $currentNode = $this->head;
        if ($currentNode && $currentNode->data === $data) {
            $this->head = $currentNode->next;
            return;
        }

        $prevNode = null;
        while ($currentNode && $currentNode->data != $data) {
            $prevNode = $currentNode;
            $currentNode = $currentNode->next;
        }

        if ($currentNode === null) {
            return;
        }

        $prevNode->next = $currentNode->next;
    }

    public function print()
    {
        $currentNode = $this->head;
        while ($currentNode) {
            echo $currentNode->data;
            $currentNode = $currentNode->next;
        }
    }

    public function reverseIterative()
    {
        $prevNode = null;
        $currentNode = $this->head;

        while ($currentNode) {
            $nextNode = $currentNode->next;
            $currentNode->next = $prevNode;

            $prevNode = $currentNode;
            $currentNode = $nextNode;
        }
        $this->head = $prevNode;
    }

    public function reverseRecursive()
    {
        function _reverseRecursive(Node $currentNode = null, Node $prevNode = null)
        {
            if (!$currentNode) {
                return $prevNode;
            }
            $nextNode = $currentNode->next;
            $currentNode->next = $prevNode;
            $prevNode = $currentNode;
            $currentNode = $nextNode;
            return _reverseRecursive($currentNode, $prevNode);
        }

        $this->head = _reverseRecursive($this->head, null);
    }

    /**
     * 1, 4, 6, 8, 9 => 1, 8, 6, 4, 9
     */
    public function reverseEven()
    {
        function _reverseEven(Node $head = null, Node $prevNode = null): ?Node
        {
            if (!$head) {
                return null;
            }

            $currentNode = $head;

            while ($currentNode && $currentNode->data % 2 === 0) {
                $nextNode = $currentNode->next;
                $currentNode->next = $prevNode;

                $prevNode = $currentNode;
                $currentNode = $nextNode;
            }

            if ($currentNode !== $head) {
                $head->next = $currentNode;
                _reverseEven($currentNode, null);
                return $prevNode;
            } else {
                $head->next = _reverseEven($head->next, $head);
                return $head;
            }
        }

        $this->head = _reverseEven($this->head, null);
    }
}

$list = new LinkedList();
$list->append(1);
$list->append(2);
$list->append(3);
$list->insert(4);
$list->insert(5);
$list->print();

echo PHP_EOL;

$list->remove(4);
$list->print();

echo PHP_EOL;

$list->reverseIterative();
$list->print();

echo PHP_EOL;

$list->reverseRecursive();
$list->print();

echo PHP_EOL;

$list = new LinkedList();
$list->append(2);
$list->append(4);
$list->append(6);
$list->append(1);
$list->append(2);
$list->append(4);
$list->append(6);
$list->append(1);

$list->reverseEven();
$list->print();
