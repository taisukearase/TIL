<?php

/**
 * 挿入ソート
 * Ave: O(n²)
 * Best: O(n)
 * Worst: O(n²)
 * Stable: Yes
 * @param int[] $list
 * @return int[]
 */
function insertionSort(array $list): array
{
    $length = count($list);

    // 配列の[1]からスタートする
    for ($i = 1; $i < $length; $i++) {
        // 一時的に値を保持する
        $tmp = $list[$i];

        // $j は $tmp の一つ後ろのインデックスをみて、インデックスが 0 以上かつひとつ後ろの値が $tmp より大きい場合は入れ替える。$j は減算していく。
        for ($j = $i - 1; $j >= 0 && $list[$j] > $tmp; $j--) {
            $list[$j + 1] = $list[$j];
        }

        // $list[$j] が $tmp より小さい、または $j < 0 の場合は現在の $j の後ろに落ち着く
        $list[$j + 1] = $tmp;
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
    $result = insertionSort($randomList);

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
