<?php

function getPair(array $nums, int $target)
{
    $cache = [];

    foreach ($nums as $num) {
        $val = $target - $num;
        if (in_array($val, $cache)) {
            return [$val, $num];
        }
        $cache[] = $num;
    }
}

function getPairHalfSum(array $nums)
{
    $sumNumbers = array_sum($nums);

    if ($sumNumbers % 2 !== 0) {
        return;
    }

    $halfSum = (int) $sumNumbers / 2;

    $cache = [];

    foreach ($nums as $num) {
        $val = $halfSum - $num;
        if (in_array($val, $cache)) {
            return [$val, $num];
        }
        $cache[] = $num;
    }
}

function getSymmetryPair(array $nums)
{
    $cache = [];
    $result = [];
    foreach ($nums as [$key, $value]) {
        $cachedValue = $cache[$value] ?? null;
        if ($cachedValue === null) {
            $cache[$key] = $value;
            continue;
        }
        if ($cachedValue === $key) {
            $result[] = [$value, $key];
        }
    }

    return $result;
}

$list = [11, 2, 5, 9, 10, 3];
$result = getPair($list, target: 12);

var_dump($result);

$result = getPairHalfSum($list);

var_dump($result);

echo PHP_EOL;

$list = [
    [1, 2],
    [3, 5],
    [4, 7],
    [5, 3],
    [7, 4],
];

$result = getSymmetryPair($list);

var_dump($result);
