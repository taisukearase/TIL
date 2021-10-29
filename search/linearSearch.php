<?php

/**
 * ライナーサーチ
 * @param int[] $list
 * @param int   $targetValue
 * @return int
 */
function linearSearch(array $list, int $targetValue): int
{
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i] === $targetValue) {
            return $i;
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
    $result = linearSearch($sortedList, $targetValue);

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
