### Hexlet tests and linter status:
[![Actions Status](https://github.com/StanislavShein/php-project-48/workflows/hexlet-check/badge.svg)](https://github.com/StanislavShein/php-project-48/actions)
[![PHP CI](https://github.com/StanislavShein/php-project-48/actions/workflows/phpci.yml/badge.svg)](https://github.com/StanislavShein/php-project-48/actions/workflows/phpci.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/c43a112720a0fab650a6/maintainability)](https://codeclimate.com/github/StanislavShein/php-project-48/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/c43a112720a0fab650a6/test_coverage)](https://codeclimate.com/github/StanislavShein/php-project-48/test_coverage)

## Use gendiff with format 'stylish' for two json and yaml files
```sh
$ ./bin/gendiff tests/fixtures/file1.json tests/fixtures/file2.json

$ ./bin/gendiff tests/fixtures/file1.yml tests/fixtures/file2.yml
```

## Use gendiff with format 'plain' for two json and yaml files
```sh
./bin/gendiff --format plain tests/fixtures/file1.json tests/fixtures/file2.json

./bin/gendiff --format plain tests/fixtures/file1.yaml tests/fixtures/file2.yaml
```

## Use gendiff with format json for two json and yaml files
```sh
./bin/gendiff --format json tests/fixtures/file1.json tests/fixtures/file2.json

./bin/gendiff --format json tests/fixtures/file.yaml tests/fixtures/file2.yaml
```