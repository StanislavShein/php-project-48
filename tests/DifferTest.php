<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $pathToJson1 = 'tests/fixtures/file1.json';
        $pathToJson2 = 'tests/fixtures/file2.json';
        $pathToResult1 = 'tests/fixtures/result1';
        $expected = file_get_contents($pathToResult1);
        $this->assertEquals($expected, genDiff($pathToJson1, $pathToJson2, ''));

        $pathToYml1 = 'tests/fixtures/file1.yml';
        $pathToYml2 = 'tests/fixtures/file2.yml';

        $this->assertEquals($expected, genDiff($pathToYml1, $pathToYml2, ''));
    }
}
