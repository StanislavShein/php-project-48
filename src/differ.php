<?php

namespace Hexlet\Code;

function genDiff($pathToFile1, $pathToFile2, $format): string
{
    $file1 = file_get_contents($pathToFile1);
    $file2 = file_get_contents($pathToFile2);

    $contentOfFile1 = json_decode($file1, true);
    $contentOfFile1 = makeBoolString($contentOfFile1);
    $contentOfFile2 = json_decode($file2, true);
    $contentOfFile2 = makeBoolString($contentOfFile2);

    $merge = array_merge($contentOfFile1, $contentOfFile2);
    $keys = array_keys($merge);
    sort($keys);

    $diff = [];
    foreach ($keys as $key) {
        if (!array_key_exists($key, $contentOfFile1)) {
            $diff[] = "+ {$key}: {$contentOfFile2[$key]}";
        } elseif (!array_key_exists($key, $contentOfFile2)) {
            $diff[] = "- {$key}: {$contentOfFile1[$key]}";
        } elseif ($contentOfFile1[$key] === $contentOfFile2[$key]) {
            $diff[] = "  {$key}: {$contentOfFile1[$key]}";
        } else {
            $diff[] = "- {$key}: {$contentOfFile1[$key]}";
            $diff[] = "+ {$key}: {$contentOfFile2[$key]}";
        }
    }
    $result = implode("\n  ", $diff);

    return "{\n  {$result}\n}";
}

function makeBoolString($arr): array
{
    foreach ($arr as $key => $value) {
        if (is_bool($arr[$key])) {
            $arr[$key] = $arr[$key] ? 'true' : "false";
        }
    }

    return $arr;
}
