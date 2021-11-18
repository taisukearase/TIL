<?php

class MiniHeap
{
    /** @var int[] */
    public array $heap = [];
    public int $currentSize = 0;

    public function __construct()
    {
        $this->heap[] = PHP_INT_MIN;
    }

    public function parentIndex(int $index): int
    {
        return (int) $index / 2;
    }

    public function leftChildIndex(int $index): int
    {
        return $index * 2;
    }

    public function rightChildIndex(int $index): int
    {
        return ($index * 2) + 1;
    }

    public function swap(int $index1, int $index2)
    {
        [$this->heap[$index1], $this->heap[$index2]] = [$this->heap[$index2], $this->heap[$index1]];
    }

    public function minChildIndex(int $index): int
    {
        if ($this->rightChildIndex($index) > $this->currentSize) {
            return $this->leftChildIndex($index);
        }

        return $this->heap[$this->leftChildIndex($index)] < $this->heap[$this->rightChildIndex($index)]
            ? $this->leftChildIndex($index)
            : $this->rightChildIndex($index);
    }

    public function heapifyUp(int $index)
    {
        while ($this->parentIndex($index) > 0) {
            if ($this->heap[$index] < $this->heap[$this->parentIndex($index)]) {
                $this->swap($index, $this->parentIndex($index));
            }
            $index = $this->parentIndex($index);
        }
    }

    public function heapifyDown(int $index)
    {
        while ($this->leftChildIndex($index) <= $this->currentSize) {
            $minChildIndex = $this->minChildIndex($index);
            if ($this->heap[$index] > $this->heap[$minChildIndex]) {
                $this->swap($index, $minChildIndex);
            }
            $index = $minChildIndex;
        }
    }

    public function push(int $value)
    {
        $this->heap[] = $value;
        $this->currentSize += 1;
        $this->heapifyUp($this->currentSize);
    }

    public function pop(): ?int
    {
        if (count($this->heap) === 1) {
            return null;
        }

        $root = $this->heap[1];
        $data = array_pop($this->heap);

        if (count($this->heap) === 1) {
            return $root;
        }

        $this->heap[1] = $data;
        $this->currentSize -= 1;
        $this->heapifyDown(1);

        return $root;
    }
}

$miniHeap = new MiniHeap();
var_dump($miniHeap->heap);

$miniHeap->push(5);
$miniHeap->push(6);
$miniHeap->push(2);
$miniHeap->push(9);
$miniHeap->push(13);
$miniHeap->push(11);
$miniHeap->push(1);
var_dump($miniHeap->heap);

$result = $miniHeap->pop(1);
var_dump($result);

var_dump($miniHeap->heap);
