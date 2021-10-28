<?php

/**
 * マージソート
 * Ave: O(n log n)
 * Best: O(n log n)
 * Worst: O(n log n)
 * Stable: Yes
 * 備考：メモリを大量に使用する
 * @param int[] $list
 * @return int[]
 */
function mergeSort(array $list): array
{
    function _mergeSort(array &$list)
    {
        $length = count($list);

        if ($length <= 1) {
            return $list;
        }

        // 小数点以下は切り捨てる
        $center = (int) ($length / 2);
        $left   = array_slice($list, 0, $center);
        $right  = array_slice($list, $center, $length);

        _mergeSort($left);
        _mergeSort($right);

        // $i は左側、$j は右側、$k はマージ先の配列のそれぞれインデックス
        $i = $j = $k = 0;

        while ($i < count($left) && $j < count($right)) {
            if ($left[$i] <= $right[$j]) {
                $list[$k] = $left[$i];
                $i++;
            } else {
                $list[$k] = $right[$j];
                $j++;
            }

            $k++;
        }

        while ($i < count($left)) {
            $list[$k] = $left[$i];
            $i++;
            $k++;
        }

        while ($j < count($right)) {
            $list[$k] = $right[$j];
            $j++;
            $k++;
        }

        return $list;
    }

    return _mergeSort($list);
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
    $result = mergeSort($randomList);

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
