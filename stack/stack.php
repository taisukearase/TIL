<?php

class Stack
{
    public array $stack;

    public function __construct()
    {
        $this->stack = [];
    }

    public function push($data)
    {
        $this->stack[] = $data;
    }

    public function pop()
    {
        if ($this->stack) {
            return array_pop($this->stack);
        }
    }
}

$stack = new Stack();
$stack->push(1);
$stack->push(2);
$res = $stack->pop();

echo $res;
var_dump($stack->stack);

function validateFormat(string $chars)
{
    $stack = [];

    $charsArr = mb_str_split($chars);

    $brackets = [
        '{' => '}',
        '[' => ']',
        '(' => ')',
    ];

    foreach ($charsArr as $char) {
        if (in_array($char, array_keys($brackets), true)) {
            $stack[] = $brackets[$char];
        }

        if (in_array($char,array_values($brackets), true)) {
            if (!$stack) {
                return false;
            }
            $popChar = array_pop($stack);
            if ($popChar !== $char) {
                return false;
            }
        }
    }

    return !$stack;

    // イケてない書き方した
    // foreach ($charsArr as $char) {
    //     if (in_array($char, ['{', '[', '('], true)) {
    //         $stack[] = match ($char) {
    //             '{' => '}',
    //             '[' => ']',
    //             '(' => ')',
    //         };
    //     }

    //     if (in_array($char, ['}', ']', ')'], true)) {
    //         $popChar = array_pop($stack);
    //         if ($popChar !== $char) {
    //             return false;
    //         }
    //     }
    // }
}

// data => expected
$formData = [
    '{[()]}' => true,
    '{([)}'  => false,
    '{([])'  => false,
    '([)]'   => false,
    ')]'     => false,
];

foreach ($formData as $chars => $expected) {
    $result = validateFormat($chars);
    echo $result === $expected ? '成功' : '失敗';
    echo PHP_EOL;
}
