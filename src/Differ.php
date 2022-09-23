<?php

namespace Differ\Differ;

use function Differ\Filereader\readFile;
use function Differ\Parsers\parse;
use function Differ\Formatters\format;
use function Functional\sort;

/**
 * @param string $pathToFile1
 * @param string $pathToFile2
 * @param string $formatName
 * @return string|false
 */
function genDiff(string $pathToFile1, string $pathToFile2, string $formatName = 'stylish')
{
    [$contentOfFile1, $extension1] = readFile($pathToFile1);
    [$contentOfFile2, $extension2] = readFile($pathToFile2);
    $data1 = parse($contentOfFile1, $extension1);
    $data2 = parse($contentOfFile2, $extension2);
    $diff = buildDiffTree($data1, $data2);

    return format($diff, $formatName);
}

/**
 * @param array<mixed> $contentOfFile1
 * @param array<mixed> $contentOfFile2
 * @return array<mixed>
 */
function buildDiffTree(array $contentOfFile1, array $contentOfFile2): array
{
    $merge = array_merge($contentOfFile1, $contentOfFile2);
    $keys = array_keys($merge);
    $sortedKeys = sort($keys, fn ($left, $right) => $left <=> $right);

    $diff = array_map(function ($key) use ($contentOfFile1, $contentOfFile2): array {
        if (array_key_exists($key, $contentOfFile1)) {
            $value1 = $contentOfFile1[$key];
        } else {
            $value2 = $contentOfFile2[$key];
            return [
                'key' => $key,
                'type' => 'added',
                'value' => $value2
            ];
        }
        if (array_key_exists($key, $contentOfFile2)) {
            $value2 = $contentOfFile2[$key];
        } else {
            return [
                'key' => $key,
                'type' => 'deleted',
                'value' => $value1
            ];
        }
        if ($value1 === $value2) {
            return [
                'key' => $key,
                'type' => 'unchanged',
                'value' => $value1
            ];
        }
        if (is_array($value1) && is_array($value2)) {
            return [
                'key' => $key,
                'type' => 'nested',
                'children' => buildDiffTree($value1, $value2)
            ];
        }

        return [
            'key' => $key,
            'type' => 'changed',
            'oldValue' => $value1,
            'newValue' => $value2
        ];
    }, $sortedKeys);

    return $diff;
}
