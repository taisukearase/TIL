<?php

/**
 * 選択ソート
 * Ave: O(n²)
 * Best: O(n²)
 * Worst: O(n²)
 * Stable: Yes
 * 備考: bubbleSort の改良
 * @param int[] $list
 * @return int[]
 */
function selectionSort(array $list): array
{
    $length = count($list);

    // 要素の個数分繰り返す
    for ($i = 0; $i < $length - 1; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $length; $j++) {
            if ($list[$minIndex] > $list[$j]) {
                $minIndex = $j;
            }
        }
        [$list[$i], $list[$minIndex]] = [$list[$minIndex], $list[$i]];
    }
    return $list;
}

/**
 * ランダムに並べた配列を返す
 * @param int[]
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
    $result = selectionSort($randomList);

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
