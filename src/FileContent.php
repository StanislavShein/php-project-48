<?php

namespace Differ\FileContent;

function getFileContent(string $pathToFile): array
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

    return makeBoolString($contentOfFile);
}
