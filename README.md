## Difference Calculator
This program calculates the difference between two json/yaml files and outputs it in stylish (default), plain or json format

## Hexlet tests and linter status:
[![Actions Status](https://github.com/StanislavShein/php-project-48/workflows/hexlet-check/badge.svg)](https://github.com/StanislavShein/php-project-48/actions)
[![PHP CI](https://github.com/StanislavShein/php-project-48/actions/workflows/phpci.yml/badge.svg)](https://github.com/StanislavShein/php-project-48/actions/workflows/phpci.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/c43a112720a0fab650a6/maintainability)](https://codeclimate.com/github/StanislavShein/php-project-48/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/c43a112720a0fab650a6/test_coverage)](https://codeclimate.com/github/StanislavShein/php-project-48/test_coverage)

## Requirements

* PHP >= 7.4
* Composer
* Make

## Setup

```sh
git clone https://github.com/StanislavShein/php-project-48.git
```
```sh
cd php-project-48/
```
```sh
make install
```

## Help
```sh
.bin/gendiff -h
```

## Use gendiff with format 'stylish' for two json and yaml files
```sh
./bin/gendiff tests/fixtures/file1.json tests/fixtures/file2.json
```
```sh
./bin/gendiff tests/fixtures/file1.yml tests/fixtures/file2.yml
```
[![asciicast](https://asciinema.org/a/23gTVq3xajTqeUifk7vCBClhm.svg)](https://asciinema.org/a/23gTVq3xajTqeUifk7vCBClhm)

## Use gendiff with format 'plain' for two json and yaml files
```sh
./bin/gendiff --format plain tests/fixtures/file1.json tests/fixtures/file2.json
```
```sh
./bin/gendiff --format plain tests/fixtures/file1.yml tests/fixtures/file2.yml
```
[![asciicast](https://asciinema.org/a/rgVsPYCGtU14vfBHMAJs9Hwch.svg)](https://asciinema.org/a/rgVsPYCGtU14vfBHMAJs9Hwch)

## Use gendiff with format 'json' for two json and yaml files
```sh
./bin/gendiff --format json tests/fixtures/file1.json tests/fixtures/file2.json
```
```sh
./bin/gendiff --format json tests/fixtures/file1.yml tests/fixtures/file2.yml
```
[![asciicast](https://asciinema.org/a/j1Su3w9eO5N4hgJG7EwE5C6iW.svg)](https://asciinema.org/a/j1Su3w9eO5N4hgJG7EwE5C6iW)