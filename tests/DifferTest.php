<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $pathToJson1 = 'tests/fixtures/file1.json';
        $pathToJson2 = 'tests/fixtures/file2.json';
        $pathToResult1 = 'tests/fixtures/result1';
        $expected1 = file_get_contents($pathToResult1);
        $this->assertEquals($expected1, genDiff($pathToJson1, $pathToJson2, ''));

        $pathToYml1 = 'tests/fixtures/file1.yml';
        $pathToYml2 = 'tests/fixtures/file2.yml';
        $this->assertEquals($expected1, genDiff($pathToYml1, $pathToYml2, ''));

        $pathToJson3 = 'tests/fixtures/file3.json';
        $pathToJson4 = 'tests/fixtures/file4.json';
        $pathToResult2 = 'tests/fixtures/result2';
        $expected2 = file_get_contents($pathToResult2);
        $this->assertEquals($expected2, genDiff($pathToJson3, $pathToJson4, ''));

        $pathToYml3 = 'tests/fixtures/file3.yml';
        $pathToYml4 = 'tests/fixtures/file4.yml';
        $this->assertEquals($expected2, genDiff($pathToYml3, $pathToYml4, ''));
    }
}
