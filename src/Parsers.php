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
    if (!file_exists($fullPathToFile)) {
        throw new \Exception("File doesn't exists");
    }
    $file = file_get_contents($fullPathToFile);
    if ($file === false) {
        throw new \Exception("File read error");
    }
    $extension = pathinfo($fullPathToFile, PATHINFO_EXTENSION);
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
