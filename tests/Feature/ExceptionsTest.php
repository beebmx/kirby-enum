<?php

use Beebmx\KirbyEnum\Exceptions\InvalidEnumException;
use Beebmx\KirbyEnum\Exceptions\InvalidEnumMethodException;
use Kirby\Form\Field;

beforeEach(function () {
    App();
});

it('throws an error if an invalid enum is set', function () {
    new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Invalid',
    ]);
})->throws(InvalidEnumException::class);

it('throws an error if an invalid enum is set with a method', function () {
    new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status::invalid',
    ]);
})->throws(InvalidEnumMethodException::class);
