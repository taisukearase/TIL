<?php

/**
 * バブルソート
 * Ave: O(n²)
 * Best: O(n)
 * Worst: O(n²)
 * Stable: Yes
 * @param int[] $list
 * @return int[]
 */
function bubbleSort(array $list): array
{
    $length = count($list);

    // limit にあたるまで繰り返す
    for ($i = 0; $i < $length - 1; $i++) {
        // limit は繰り返すたびに1ずつ狭まる
        for ($j = 0; $j < $length - 1 - $i; $j++) {
            // 現在の要素が次の要素より大きければ値を入れ替える
            if ($list[$j] > $list[$j + 1]) {
                [$list[$j], $list[$j + 1]] = [$list[$j + 1], $list[$j]];
            }
        }
    }
    return $list;
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
    $result = bubbleSort($randomList);

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
