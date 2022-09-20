<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $jsonFile1 = 'tests/fixtures/file1.json';
        $jsonFile2 = 'tests/fixtures/file2.json';
        $ymlFile1 = 'tests/fixtures/file1.yml';
        $ymlFile2 = 'tests/fixtures/file2.yml';

        $pathToStylish = 'tests/fixtures/stylish';
        $expectedStylish = file_get_contents($pathToStylish);
        $pathToJson = 'tests/fixtures/json';
        $expectedJson = file_get_contents($pathToJson);
        $pathToPlain = 'tests/fixtures/plain';
        $expectedPlain = file_get_contents($pathToPlain);

        $this->assertEquals($expectedStylish, genDiff($jsonFile1, $jsonFile2, 'stylish'));
        $this->assertEquals($expectedStylish, genDiff($ymlFile1, $ymlFile2, 'stylish'));
        $this->assertEquals($expectedJson, genDiff($jsonFile1, $jsonFile2, 'json'));
        $this->assertEquals($expectedJson, genDiff($ymlFile1, $ymlFile2, 'json'));
        $this->assertEquals($expectedPlain, genDiff($jsonFile1, $jsonFile2, 'plain'));
        $this->assertEquals($expectedPlain, genDiff($ymlFile1, $ymlFile2, 'plain'));
    }
}
