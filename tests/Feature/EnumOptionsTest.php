<?php

use Beebmx\KirbyEnum\Actions\GetEnumOptions;
use Kirby\Form\Field;

beforeEach(function () {
    App();
});

it('wont throw an error with a valid enum', function () {
    new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status',
    ]);
})->throwsNoExceptions();

it('returns an array of options formated', function () {
    $field = new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status',
    ]);

    expect((new GetEnumOptions)($field))
        ->toBeArray()
        ->toHaveCount(3);
});

it('can default cases method to retrieve enum options', function () {
    $field = new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status::cases',
    ]);

    expect((new GetEnumOptions)($field))
        ->toBeArray()
        ->toHaveCount(3);
});

it('can call a static method to retrieve enum options', function () {
    $field = new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status::published',
    ]);

    expect((new GetEnumOptions)($field))
        ->toBeArray()
        ->toHaveCount(2);
});

it('can call a static method with parentheses to retrieve enum options', function () {
    $field = new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status::published()',
    ]);

    expect((new GetEnumOptions)($field))
        ->toBeArray()
        ->toHaveCount(2);
});

it('returns a valid options for fields', function () {
    $field = new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Status',
    ]);

    expect((new GetEnumOptions)($field))
        ->each
        ->toHaveKeys(['value', 'text']);
});

it('can implements HasLabel to transform output', function () {
    $field = new Field('enum', [
        'enum' => 'Tests\Fixtures\App\Enums\Network',
    ]);

    expect((new GetEnumOptions)($field))
        ->each(
            fn ($item) => expect($item->value['text'])->toStartWith('Network')
        );
});
