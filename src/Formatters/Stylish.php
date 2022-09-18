<?php

namespace Differ\Formatters\Stylish;

function format(array $data): string
{
    $lines = makeStylish($data);
    $result = implode("\n", $lines);

    return "{\n{$result}\n}";
}

function makeStylish(array $diffTree, int $depth = 0): array
{
    $indent = str_repeat('    ', $depth);
    $nextDepth = $depth + 1;
    $result = array_map(function (array $node) use ($indent, $nextDepth) {
        $type = $node['type'];
        $key = $node['key'];
        switch ($type) {
            case 'deleted':
                $value = makeString($node['value'], $nextDepth);
                return "{$indent}  - {$key}: {$value}/{$nextDepth}/";

            case 'added':
                $value = makeString($node['value'], $nextDepth);
                return "{$indent}  + {$key}: {$value}/{$nextDepth}/";

            case 'unchanged':
                $value = makeString($node['value'], $nextDepth);
                return "{$indent}    {$key}: {$value}/{$nextDepth}/";

            case 'changed':
                $oldValue = makeString($node['oldValue'], $nextDepth);
                $newValue = makeString($node['newValue'], $nextDepth);
                return "{$indent}  - {$key}: {$oldValue}/{$nextDepth}/\n{$indent}  + {$key}: {$newValue}/{$nextDepth}/";

            case 'nested':
                $child = makeStylish($node['children'], $nextDepth);
                $stringNested = implode("\n{$indent}", $child);
                return "{$indent}    {$key}: {\n{$stringNested}\n{$indent}    }";
        }
    }, $diffTree);

    return $result;
}

function makeString($value, $depth): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        $result = arrayToString($value, $depth);
        $indent = str_repeat('    ', $depth);
        $modified = "{{$result}\n{$indent}}";

        return $modified;
    }

    return "{$value}";
}

function arrayToString($arrayValue, $depth): string
{
    $keys = array_keys($arrayValue);
    $nextDepth = $depth + 1;
    $result = array_map(function ($key) use ($arrayValue, $nextDepth) {
        $val = makeString($arrayValue[$key], $nextDepth);
        $indent = str_repeat('    ', $nextDepth);
        $result = "\n{$indent}{$key}: {$val}";

        return $result;
    }, $keys);

    return implode('', $result);
}
