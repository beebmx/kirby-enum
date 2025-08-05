<?php

use Beebmx\KirbyEnum\Actions\FieldToEnum;
use Kirby\Content\Field;

return [
    'toEnum' => fn (Field $field) => (new FieldToEnum)($field),
];
