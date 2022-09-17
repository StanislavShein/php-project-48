<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($pathToFile): array
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
    }

    return $contentOfFile;
}

/*function makeBoolString(array $arr): array
{
    foreach ($arr as $key => $value) {
        if (is_bool($arr[$key])) {
            $arr[$key] = $arr[$key] ? 'true' : "false";
        }
    }

    return $arr;
}*/

function getFullPathToFile(string $file): string
{
    if (strpos($file, '/') === 0) {
        return $file;
    }

    return __DIR__ . '/../' . $file;
}
