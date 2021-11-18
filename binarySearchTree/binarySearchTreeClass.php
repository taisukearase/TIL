<?php

class Node
{
    public ?Node $left  = null;
    public ?Node $right = null;

    public function __construct(public ?int $value = null)
    {
    }
}

class BinarySearchTree
{
    public ?Node $root = null;

    public function __construct()
    {
    }


    public function _insert(?Node $node, int $value): Node
    {
        if ($node === null) {
            return new Node($value);
        }

        if ($value < $node->value) {
            $node->left = $this->_insert($node->left, $value);
        } else {
            $node->right = $this->_insert($node->right, $value);
        }

        return $node;
    }

    public function insert(int $value)
    {
        if ($this->root === null) {
            $this->root = new Node($value);
            return;
        }

        $this->_insert($this->root, $value);
    }

    public function inOrder(?Node $node = null, bool $isRecursive = false)
    {
        if (!$isRecursive) {
            $node = $this->root;
        }

        if ($node) {
            $this->inOrder($node->left, isRecursive: true);
            echo $node->value;
            $this->inOrder($node->right, isRecursive: true);
        }
    }

    public function search(int $value): bool
    {
        function _search(?Node $node, int $value): bool
        {
            if (!$node) {
                return false;
            }

            if ($node->value === $value) {
                return true;
            }

            if ($node->value > $value) {
                return _search($node->left, $value);
            }

            if ($node->value < $value) {
                return _search($node->right, $value);
            }
        }

        return _search($this->root, $value);
    }

    public function minValue(Node $node): ?Node
    {
        $current = $node;

        while ($current->left !== null) {
            $current = $current->left;
        }

        return $current;
    }

    public function remove(int $value)
    {
        function _remove(?Node $node, int $value): Node|null
        {
            if (!$node) {
                return $node;
            }

            if ($value < $node->value) {
                $node->left = _remove($node->left, $value);
            } elseif ($value > $node->value) {
                $node->right = _remove($node->right, $value);
            } else {
                if ($node->left === null) {
                    return $node->right;
                }
                if ($node->right === null) {
                    return $node->left;
                }

                $tmp = minValue($node->right);
                $node->value = $tmp->value;
                $node->right = _remove($node->right, $tmp->value);
            }

            return $node;
        }

        _remove($this->root, $value);
    }
}

$tree = new BinarySearchTree();
$tree->insert(3);
$tree->insert(6);
$tree->insert(5);
$tree->insert(7);
$tree->insert(1);
$tree->insert(10);
$tree->insert(2);

$tree->inOrder();
echo PHP_EOL;
echo $tree->search(7);
echo PHP_EOL;

$tree->remove(7);
$tree->inOrder();
