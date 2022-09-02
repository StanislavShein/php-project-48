<?php

namespace Hexlet\Code;

function genDiff($pathToFile1, $pathToFile2, $format): string
{
    $file1 = file_get_contents($pathToFile1);
    $file2 = file_get_contents($pathToFile2);

    $contentOfFile1 = json_decode($file1, true);
    $contentOfFile2 = json_decode($file2, true);

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
    $result = implode("\n", $diff);

    return "{ \n {$result} \n } \n";
}
