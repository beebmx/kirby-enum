<?php

namespace Beebmx\KirbyEnum\Actions;

use Kirby\Toolkit\Str;

class ValueToArray
{
    public function __invoke($value): array
    {
        if (is_null($value) === true) {
            return [];
        }

        if (is_array($value) === false) {
            $value = Str::split($value, ',');
        }

        return $value;
    }
}
