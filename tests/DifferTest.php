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
        $this->assertEquals($expected, genDiff($file1, $file2, $format));
    }

    /**
     * @return array<mixed>
     */
    public function additionProvider(): array
    {
        return [
            'json file to stylish format' => [
                file_get_contents('tests/fixtures/stylish'),
                'tests/fixtures/file1.json',
                'tests/fixtures/file2.json',
                'stylish'
            ],
            'json file to json format' => [
                file_get_contents('tests/fixtures/json'),
                'tests/fixtures/file1.json',
                'tests/fixtures/file2.json',
                'json'
            ],
            'json file to plain format' => [
                file_get_contents('tests/fixtures/plain'),
                'tests/fixtures/file1.json',
                'tests/fixtures/file2.json',
                'plain'
            ],
            'yaml file to stylish format' => [
                file_get_contents('tests/fixtures/stylish'),
                'tests/fixtures/file1.yml',
                'tests/fixtures/file2.yml',
                'stylish'
            ],
            'yaml file to json format' => [
                file_get_contents('tests/fixtures/json'),
                'tests/fixtures/file1.yml',
                'tests/fixtures/file2.yml',
                'json'
            ],
            'yaml file to plain format' => [
                file_get_contents('tests/fixtures/plain'),
                'tests/fixtures/file1.yml',
                'tests/fixtures/file2.yml',
                'plain'
            ]
        ];
    }
}
