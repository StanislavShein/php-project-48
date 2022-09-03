<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\genDiff;

function getFixtureFullPath(string $fixtureName): string
{
    $parts = [__DIR__, 'fixtures', $fixtureName];

    return realpath(implode('/', $parts));
}

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $pathToJson1 = getFixtureFullPath('file1.json');
        $pathToJson2 = getFixtureFullPath('file2.json');
        $pathToResult1 = getFixtureFullPath('result1');

        $expected = file_get_contents($pathToResult1);
        $this->assertEquals($expected, genDiff($pathToJson1, $pathToJson2, ''));
    }
}
