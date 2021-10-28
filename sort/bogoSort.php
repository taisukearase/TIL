<?php

/**
 * ボゴソート
 * Ave: O((n + 1)!)
 * Best: O(n)
 * Worst: Unbounded
 * Stable: No
 * @param int[] $list
 * @return int[]
 */
function bogoSort(array $list): array
{
    while (!isInOrder($list)) {
        shuffle($list);
    }

    return $list;
}

/**
 * 配列が順番通りかを検査
 * @param int[] $list
 * @return bool
 */
function isInOrder(array $list): bool
{
    for ($i = 0, $length = count($list); $i < $length - 1; $i++) {
        if ($list[$i] > $list[$i + 1]) {
            return false;
        }
    }
    return true;
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
    $result = bogoSort($randomList);

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
