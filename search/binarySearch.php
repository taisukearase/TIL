<?php

/**
 * バイナリサーチ
 * @param int[] $list
 * @param int   $targetValue
 * @return int
 */
function binarySearch(array $list, int $targetValue): int
{
    function _binarySearch(array $list, int $targetValue, int $left, int $right)
    {
        if ($left > $right) {
            return -1;
        }

        $mid = (int) (($left + $right) / 2);
        if ($list[$mid] === $targetValue) {
            return $mid;
        }
        if ($list[$mid] < $targetValue) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }

        return _binarySearch($list, $targetValue, $left, $right);
    }

    return _binarySearch($list, $targetValue, left: 0, right: count($list));
}

function binarySearchUseWhile(array $list, int $targetValue): int
{
    $left  = 0;
    $right = count($list) - 1;

    while ($left <= $right) {
        $mid = (int) (($left + $right) / 2);
        if ($list[$mid] === $targetValue) {
            return $mid;
        }
        if ($list[$mid] < $targetValue) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return -1;
}

/**
 * 処理を実行し、実行時間と使用メモリを出力する
 */
function testSearch(): void
{
    $sortedList  = range(0, 9);
    $targetValue = random_int(0, 10);

    // 実行開始時間と現在のメモリを取得
    $startTime     = microtime(true);
    $initialMemory = memory_get_usage();

    // 処理を実行
    $result = binarySearch($sortedList, $targetValue);

    // 実行時間とメモリを算出
    $runningTime = sprintf('%.8f', microtime(true) - $startTime);
    $usedMemory  = memory_get_peak_usage() - $initialMemory;

    // 結果を出力
    $listStr = implode(", ", $sortedList);
    echo "origin list: [{$listStr}]" . PHP_EOL;
    echo "target value: {$targetValue}" . PHP_EOL;
    echo "running time: {$runningTime} [s]" . PHP_EOL;
    echo "used memory: {$usedMemory} [bytes]" . PHP_EOL;
    echo "result: {$result}" . PHP_EOL;
}

testSearch();
