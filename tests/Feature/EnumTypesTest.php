<?php

use Beebmx\KirbyEnum\Actions\GetEnumOptions;
use Kirby\Form\Field;

beforeEach(function () {
    App();
});

describe('string', function () {
    it('wont throw an exception', function () {
        new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\Status',
        ]);
    })->throwsNoExceptions();

    it('returns an array of options', function () {
        $field = new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\Status',
        ]);

        expect((new GetEnumOptions)($field))
            ->toBeArray()
            ->toHaveCount(3);
    });

    it('returns key value as string', function () {
        $field = new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\Status',
        ]);

        expect((new GetEnumOptions)($field))
            ->each(
                fn ($item) => expect($item->value['value'])
                    ->not->toBeNull()
                    ->toBeString()
                    ->toBeIn(['draft', 'published', 'archived'])
            );
    });
});

describe('int', function () {
    it('wont throw an exception', function () {
        new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\StatusInt',
        ]);
    })->throwsNoExceptions();

    it('returns an array of options', function () {
        $field = new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\StatusInt',
        ]);

        expect((new GetEnumOptions)($field))
            ->toBeArray()
            ->toHaveCount(3);
    });

    it('returns key value as int', function () {
        $field = new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\StatusInt',
        ]);

        expect((new GetEnumOptions)($field))
            ->each(
                fn ($item) => expect($item->value['value'])
                    ->not->toBeNull()
                    ->toBeString()
                    ->toBeIn(['0', '1', '2'])
            );
    });
});

describe('plain', function () {
    it('wont throw an exception', function () {
        new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\StatusPlain',
        ]);
    })->throwsNoExceptions();

    it('returns an array of options', function () {
        $field = new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\StatusPlain',
        ]);

        expect((new GetEnumOptions)($field))
            ->toBeArray()
            ->toHaveCount(3);
    });

    it('returns key value as string', function () {
        $field = new Field('enum', [
            'enum' => 'Tests\Fixtures\App\Enums\StatusPlain',
        ]);

        expect((new GetEnumOptions)($field))
            ->each(
                fn ($item) => expect($item->value['value'])
                    ->not->toBeNull()
                    ->toBeString()
                    ->toBeIn(['Draft', 'Published', 'Archived'])
            );
    });
});
