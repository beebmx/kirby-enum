<?php

namespace Beebmx\KirbyEnum\Actions;

use Beebmx\KirbyEnum\Exceptions\InvalidEnumException;
use Kirby\Cms\Page;
use Kirby\Content\Field;
use Kirby\Toolkit\Str;
use ReflectionEnum;
use ReflectionException;
use UnitEnum;

class FieldToEnum
{
    /**
     * @throws InvalidEnumException|ReflectionException
     */
    public function __invoke(Field $field): ?UnitEnum
    {
        $blueprint = $this->getField($field->parent(), $field);

        if ($blueprint === null) {
            return null;
        }

        return $this->getCaseBy($blueprint['enum'] ?? null, $field->value);
    }

    protected function getField(?Page $page, Field $field): ?array
    {
        if ($page === null) {
            return null;
        }

        return array_find($page->blueprint()->fields(), function ($value, $key) use ($field) {
            return Str::lower($key) === Str::lower($field->key());
        });
    }

    /**
     * @throws InvalidEnumException|ReflectionException
     */
    protected function getCaseBy(?string $enum, string|int $value): ?UnitEnum
    {
        if ($enum === null) {
            return null;
        }

        [$enum, $method] = array_pad(
            explode('::', $enum),
            2,
            null
        );

        if (! enum_exists($enum)) {
            throw new InvalidEnumException(
                "The given enum {$enum} does not exist or is not a valid enum."
            );
        }

        return $this->getCaseFrom(new ReflectionEnum($enum), $value);
    }

    /**
     * @throws ReflectionException
     */
    protected function getCaseFrom(ReflectionEnum $enum, string|int $value): UnitEnum
    {
        return $enum->implementsInterface('BackedEnum')
            ? $enum
                ->getMethod('from')
                ->invoke(null, $value)
            : array_find(
                $enum->getMethod('cases')->invoke(null),
                fn ($case) => $case->name === $value || $case->value === $value
            );
    }
}
