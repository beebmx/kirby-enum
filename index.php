<?php

use Kirby\Cms\App as Kirby;

@include_once __DIR__.'/vendor/autoload.php';

Kirby::plugin('beebmx/enum', [
    'fieldMethods' => require_once __DIR__.'/extensions/fieldMethods.php',
    'fields' => require_once __DIR__.'/extensions/fields.php',
]);
