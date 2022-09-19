<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

/**
 * @param string $pathToFile
 * @return array<mixed>
 */
function parse(string $pathToFile): array
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
        case 'yaml':
            $stdClass = Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
            $contentOfFile = (array)$stdClass;
            break;

        default:
            throw new \Exception("Unknow file type {$extension}");
    }

    return $contentOfFile;
}

/**
 * @param string $file
 * @return string
 */
function getFullPathToFile(string $file): string
{
    if (strpos($file, '/') === 0) {
        return $file;
    }

    return __DIR__ . '/../' . $file;
}
