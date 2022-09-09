<?php

namespace Hexlet\Code;

use Symfony\Component\Yaml\Yaml;

function genDiff($pathToFile1, $pathToFile2, $format): string
{
    $contentOfFile1 = getFileContent($pathToFile1);
    $contentOfFile2 = getFileContent($pathToFile2);

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

function getFullPathToFile(string $file): string
{
    if (strpos($file, '/') === 0) {
        return $file;
    }

    return __DIR__ . '/../' . $file;
}

function getFileContent($pathToFile)
{
    $fullPathToFile = getFullPathToFile($pathToFile);
    $file = file_get_contents($fullPathToFile);
    $extension = pathinfo($fullPathToFile, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'json':
            $contentOfFile = json_decode($file, true);
            break;
        case 'yml':
            $stdClass = Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
            $contentOfFile = (array)$stdClass;
            break;
    }

    return makeBoolString($contentOfFile);
}
