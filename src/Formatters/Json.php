<?php

namespace Differ\Formatters\Json;

/**
 * @param array<mixed> $data
 * @return mixed
 */
function format(array $data)
{
    return json_encode($data, JSON_PRETTY_PRINT);
}
