<?php
// Input :'This is a pen. This is an apple. Applepen'
// Output:('p', 6)

function countChars(string $input): array
{
    $lowerStr = strtolower($input);
    $testStr  = str_replace(search: ' ', replace: '', subject: $lowerStr);
    $strChars = str_split($testStr);

    $resultArr = [];

    foreach ($strChars as $char) {
        $resultArr[$char] = substr_count($testStr, $char);
    }

    $maxCount = max($resultArr);
    $maxKeys  = array_keys($resultArr, $maxCount);

    return [$maxKeys[0], $maxCount];
}

$input = 'This is a pen. This is an apple. Applepen';
$expected = ['p', 6];

$actual = countChars($input);

$result = $actual === $expected;

var_dump($actual);
var_dump($expected);
var_dump($result);
