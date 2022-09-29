<?php

namespace Differ\FileReader;

/**
 * @param string $path
 * @return array<mixed>
 */
function readFile(string $path): array
{
    $fullPath = getFullPath($path);
    if (!file_exists($fullPath)) {
        throw new \Exception("File doesn't exists");
    }

    $file = file_get_contents($fullPath);
    if ($file === false) {
        throw new \Exception("File read error");
    }

    $extension = pathinfo($fullPath, PATHINFO_EXTENSION);

    return [$file, $extension];
}

/**
 * @param string $file
 * @return string
 */
function getFullPath(string $file): string
{
    if (strpos($file, '/') === 0) {
        return $file;
    }

    return __DIR__ . '/../' . $file;
}
