<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

/**
 * @param string $file
 * @param string $type
 * @return array<mixed>
 */
function parse(string $file, string $type): array
{
    switch ($type) {
        case 'json':
            return json_decode($file, true);
        case 'yml':
        case 'yaml':
            return Yaml::parse($file);
        default:
            throw new \Exception("Unknow file type {$type}");
    }
}
