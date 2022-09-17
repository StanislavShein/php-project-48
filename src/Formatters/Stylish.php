<?php

namespace Differ\Formatters\Stylish;

function format(array $data): string
{
    $lines = makeStylish($data);
    $result = implode("\n", $lines);

    return "{\n{$result}\n}\n";
}

function makeStylish(array $diff): array
{
    $result = array_map(function ($node) {
        switch ($node['type']) {
            case 'deleted':
                $value = makeString($node['value']);
                return "- {$node['key']}: {$value}";

            case 'added':
                $value = makeString($node['value']);
                return "+ {$node['key']}: {$value}";

            case 'unchanged':
                $value = makeString($node['value']);
                return "  {$node['key']}: {$value}";

            case 'changed':
                $oldValue = makeString($node['oldValue']);
                $newValue = makeString($node['newValue']);
                return "- {$node['key']}: {$oldValue}\n+ {$node['key']}: {$newValue}";

            case 'nested':
                return "тут надо что-то придумать";
        }
    }, $diff);

    return $result;
}

function makeString($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if (is_null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        $keys = array_keys($value);
        $result = array_map(function ($key) use ($value) {
            $val = makeString($value[$key]);
            $result = "{$key}: {$val}";

            return $result;
        }, $keys);

        return implode('', $result);
    }

    return "{$value}";

}
