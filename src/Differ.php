<?php

namespace Differ\Differ;

use function Differ\Parsers\parse;
use function Differ\Formatters\Stylish\format;

function genDiff(string $pathToFile1, string $pathToFile2, string $format)
{
    $contentOfFile1 = parse($pathToFile1);
    $contentOfFile2 = parse($pathToFile2);

    $merge = array_merge($contentOfFile1, $contentOfFile2);
    $keys = array_keys($merge);
    sort($keys);

    $diff = array_map(function ($key) use ($contentOfFile1, $contentOfFile2) {
        if (!array_key_exists($key, $contentOfFile2)) {
            return['key' => $key, 'type' => 'deleted', 'value' => $contentOfFile1[$key]];
        }
        if (!array_key_exists($key, $contentOfFile1)) {
            return ['key' => $key, 'type' => 'added', 'value' => $contentOfFile2[$key]];
        }
        if ($contentOfFile1[$key] === $contentOfFile2[$key]) {
            return ['key' => $key, 'type' => 'unchanged', 'value' => $contentOfFile1[$key]];
        }
        if (is_array($contentOfFile1[$key]) || is_array($contentOfFile2[$key])) {
            return ['key' => $key, 'type' => 'nested', 'value' => $contentOfFile1[$key]];
        }

        return ['key' => $key, 'type' => 'changed',
            'oldValue' => $contentOfFile1[$key], 'newValue' => $contentOfFile2[$key]];
    }, $keys);

    return format($diff);
}
