<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\format as formatStylish;
use function Differ\Formatters\Json\format as formatJson;
use function Differ\Formatters\Plain\format as formatPlain;

function format(array $diff, string $formatName): string
{
    switch ($formatName) {
        case 'stylish':
            return formatStylish($diff);

        case 'json':
            return formatJson($diff);

        case 'plain':
            return formatPlain($diff);

        default:
            throw new \Exception("Unknown format {$formatName}");
    }
}