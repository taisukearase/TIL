<?php

class Node
{
    public $left  = null;
    public $right = null;

    public function __construct(public $value)
    {
    }
}

function insert(?Node $node, $value): Node
{
    if ($node === null) {
        return new Node($value);
    }

    if ($value < $node->value) {
        $node->left = insert($node->left, $value);
    } else {
        $node->right = insert($node->right, $value);
    }

    return $node;
}

function inOrder(?Node $node)
{
    if ($node) {
        inOrder($node->left);
        echo $node->value;
        inOrder($node->right);
    }
}

function search(?Node $node, int $value): bool
{
    if (!$node) {
        return false;
    }

    if ($node->value === $value) {
        return true;
    }
    
    if ($node->value > $value) {
        return search($node->left, $value);
    }

    if ($node->value < $value) {
        return search($node->right, $value);
    }
}

$root = null;
$root = insert($root, 3);
$root = insert($root, 6);
$root = insert($root, 5);
$root = insert($root, 7);
$root = insert($root, 1);
$root = insert($root, 10);
$root = insert($root, 2);

echo $root->right->left->value;
echo PHP_EOL;
echo $root->left->right->value;
echo PHP_EOL;
echo inOrder($root);
echo PHP_EOL;
echo search($root, 1);
