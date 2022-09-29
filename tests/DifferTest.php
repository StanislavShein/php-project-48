<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     *
     * @param string $expected
     * @param string $file1
     * @param string $file2
     * @param string $format
     * @return void
     */
    public function testDiffer($expected, $file1, $file2, $format): void
    {
        $fullPathToExpected = $this->getFullPathToFixture($expected);
        $fullPathToFile1 = $this->getFullPathToFixture($file1);
        $fullPathToFile2 = $this->getFullPathToFixture($file2);
        $this->assertStringEqualsFile($fullPathToExpected, genDiff($fullPathToFile1, $fullPathToFile2, $format));
    }

    /**
     * @return array<mixed>
     */
    public function additionProvider(): array
    {
        return [
            'json file to stylish format' => [
                'stylish',
                'file1.json',
                'file2.json',
                'stylish'
            ],
            'json file to json format' => [
                'json',
                'file1.json',
                'file2.json',
                'json'
            ],
            'json file to plain format' => [
                'plain',
                'file1.json',
                'file2.json',
                'plain'
            ],
            'yaml file to stylish format' => [
                'stylish',
                'file1.yml',
                'file2.yml',
                'stylish'
            ],
            'yaml file to json format' => [
                'json',
                'file1.yml',
                'file2.yml',
                'json'
            ],
            'yaml file to plain format' => [
                'plain',
                'file1.yml',
                'file2.yml',
                'plain'
            ]
        ];
    }

    /**
     * @param string $file
     * @return string
     */
    public function getFullPathToFixture(string $file): string
    {
        return __DIR__ . "/fixtures/" . $file;
    }
}
