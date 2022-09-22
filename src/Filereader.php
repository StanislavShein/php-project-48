<?php

namespace Differ\Filereader;

/**
 * @param string $pathToFile
 * @return array<mixed>
 */
function readFile(string $pathToFile): array
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

    return [$file, $extension];
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
