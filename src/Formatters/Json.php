<?php

namespace Differ\Formatters\Json;

/**
 * @param array<mixed> $data
 * @return string|false
 */
function format(array $data)
{
    return json_encode($data);
}
