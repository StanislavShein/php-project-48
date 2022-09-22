<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

/**
 * @param string $file
 * @param string $extension
 * @return array<mixed>
 */
function parse(string $file, string $extension): array
{
    switch ($extension) {
        case 'json':
            $contentOfFile = json_decode($file, true);
            break;
        case 'yml':
            $contentOfFile = Yaml::parse($file);
            break;
        case 'yaml':
            $contentOfFile = Yaml::parse($file);
            break;

        default:
            throw new \Exception("Unknow file type {$extension}");
    }

    return $contentOfFile;
}
