<?php

namespace Differ\Formatters\Stylish;

/**
 * @param array<mixed> $data
 * @return string
 */
function format(array $data): string
{
    $lines = makeStylish($data);
    $result = implode("\n", $lines);

    return "{\n{$result}\n}";
}

/**
 * @param array<mixed> $diffTree
 * @param int $depth
 * @return array<mixed>
 */
function makeStylish(array $diffTree, int $depth = 0): array
{
    $indent = getIndent($depth);
    $nextDepth = $depth + 1;
    $result = array_map(function (array $node) use ($indent, $nextDepth) {
        $key = $node['key'];
        $type = $node['type'];
        switch ($type) {
            case 'deleted':
                $value = makeString($node['value'], $nextDepth);
                return "{$indent}  - {$key}: {$value}";

            case 'added':
                $value = makeString($node['value'], $nextDepth);
                return "{$indent}  + {$key}: {$value}";

            case 'unchanged':
                $value = makeString($node['value'], $nextDepth);
                return "{$indent}    {$key}: {$value}";

            case 'changed':
                $oldValue = makeString($node['oldValue'], $nextDepth);
                $newValue = makeString($node['newValue'], $nextDepth);
                return "{$indent}  - {$key}: {$oldValue}\n{$indent}  + {$key}: {$newValue}";

            case 'nested':
                $child = makeStylish($node['children'], $nextDepth);
                $stringNested = implode("\n", $child);
                return "{$indent}    {$key}: {\n{$stringNested}\n{$indent}    }";

            default:
                throw new \Exception("Unknown type {$type}");
        }
    }, $diffTree);

    return $result;
}

/**
 * @param mixed $value
 * @param int $depth
 * @return string
 */
function makeString(mixed $value, int $depth): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        $result = arrayToString($value, $depth);
        $indent = getIndent($depth);
        $modified = "{{$result}\n{$indent}}";

        return $modified;
    }

    return "{$value}";
}

/**
 * @param array<mixed> $arrayValue
 * @param int $depth
 * @return string
 */
function arrayToString(array $arrayValue, int $depth): string
{
    $keys = array_keys($arrayValue);
    $inDepth = $depth + 1;
    $result = array_map(function ($key) use ($arrayValue, $inDepth) {
        $val = makeString($arrayValue[$key], $inDepth);
        $indent = getIndent($inDepth);
        $result = "\n{$indent}{$key}: {$val}";

        return $result;
    }, $keys);

    return implode('', $result);
}

function getIndent(int $repeat): string
{
    return str_repeat('    ', $repeat);
}
