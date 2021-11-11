<?php

class HashTable
{
    public array $table;

    public function __construct(public int $size = 10)
    {
        $this->table = array_fill(0, $size, []);
    }

    public function hash(string $key): int
    {
        return hexdec(substr(md5($key), offset: 0, length: 5)) % $this->size;
    }

    public function add(string $key, string $value)
    {
        $index = $this->hash($key);

        $this->table[$index][$key] = $value;
    }

    public function get(string $key): mixed
    {
        $index = $this->hash($key);
        return $this->table[$index][$key] ?? null;
    }
}

$hashTable = new HashTable();
$hashTable->add('car', 'Tesla');
$hashTable->add('car', 'Toyota');
$hashTable->add('pc', 'mac');
$hashTable->add('sns', 'youtube');
$hashTable->add('work', 'programing');

var_dump($hashTable->table);
echo $hashTable->get('work');
echo $hashTable->get('hoge');
