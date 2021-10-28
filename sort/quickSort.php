<?php

/**
 * クイックソート
 * Ave: O(n log n)
 * Best: O(n log n)
 * Worst: O(n²)
 * Stable: No
 * @param int[] $list
 * @return int[]
 */
function quickSort(array $list): array
{
    function _quickSort(array &$list, int $low, int $high)
    {
        if ($low < $high) {
            $partitionIndex = partition($list, $low, $high);
            // パーティションの右側と左側のソートを再帰で実行する
            _quickSort($list, $low, $partitionIndex - 1);
            _quickSort($list, $partitionIndex + 1, $high);
        }
    };

    _quickSort($list, 0, count($list) - 1);
    return $list;
}

/**
 * @param int[] &$list
 * @param int   $low
 * @param int   $high
 * @return int
 */
function partition(array &$list, int $low, int $high): int
{
    $i     = $low - 1;
    $pivot = $list[$high];

    for ($j = $low; $j < $high; $j++) {
        if ($list[$j] <= $pivot) {
            $i++;
            [$list[$i], $list[$j]] = [$list[$j], $list[$i]];
        }
    }

    $partitionIndex = $i + 1;

    [$list[$partitionIndex], $list[$high]] = [$list[$high], $list[$partitionIndex]];

    return $partitionIndex;
}

/**
 * ランダムに並べた配列を返す
 * @param int[] $list
 * @return int[]
 */
function makeRandomList(array $list): array
{
    shuffle($list);
    return $list;
}

/**
 * ソートを実行し、実行時間と使用メモリを出力する
 */
function testSort(): void
{
    // 元となる配列とランダムに入れ替えた配列を用意する
    $expected   = range(0, 9);
    $randomList = makeRandomList($expected);

    // 実行開始時間と現在のメモリを取得
    $startTime     = microtime(true);
    $initialMemory = memory_get_usage();

    // ソート処理を実行
    $result = quickSort($randomList);

    // 実行時間とメモリを算出
    $runningTime = sprintf('%.8f', microtime(true) - $startTime);
    $usedMemory  = memory_get_peak_usage() - $initialMemory;

    // 結果を出力
    $randomStr = implode(", ", $randomList);
    $resultStr = implode(", ", $result);
    echo "origin list: [{$randomStr}]" . PHP_EOL;
    echo "sort result: [{$resultStr}]" . PHP_EOL;
    echo "running time: {$runningTime} [s]" . PHP_EOL;
    echo "used memory: {$usedMemory} [bytes]" . PHP_EOL;
    echo $expected === $result ? 'ソートに成功しました' : 'ソートに失敗しました' . PHP_EOL;
}

testSort();
