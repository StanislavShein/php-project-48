<?php

namespace Differ\Formatters\Plain;

/**
 * @param array<mixed> $data
 * @return string
 */
function format(array $data): string
{
    $lines = makePlain($data);
    return implode("\n", $lines);
}

/**
 * @param array<mixed> $diffTree
 * @param string $path
 * @return array<mixed>
 */
function makePlain(array $diffTree, string $path = ''): array
{
    $result = array_map(function ($node) use ($path) {
        $key = $node['key'];
        $type = $node['type'];
        $property = "{$path}{$key}";
        switch ($type) {
            case 'deleted':
                return "Property '{$property}' was removed";

            case 'added':
                $value = makeString($node['value']);
                return "Property '{$property}' was added with value: {$value}";

            case 'unchanged':
                return '';

            case 'changed':
                $oldValue = makeString($node['oldValue']);
                $newValue = makeString($node['newValue']);
                return "Property '$property' was updated. From {$oldValue} to {$newValue}";

            case 'nested':
                $nestedPath = "{$path}{$key}.";
                $nestedNode = implode("\n", makePlain($node['children'], $nestedPath));
                return $nestedNode;

            default:
                throw new \Exception("Unknown type {$type}");
        }
    }, $diffTree);

    return $result;
}

/**
 * @param mixed $value
 * @return string
 */
function makeString($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        return '[complex value]';
    }

    return "'{$value}'";
}
