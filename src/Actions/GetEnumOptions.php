<?php

namespace Beebmx\KirbyEnum\Actions;

use Beebmx\KirbyEnum\Contracts\HasLabel;
use Beebmx\KirbyEnum\Exceptions\InvalidEnumException;
use Beebmx\KirbyEnum\Exceptions\InvalidEnumMethodException;
use Kirby\Form\Field;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Str;
use ReflectionEnum;
use ReflectionException;

class GetEnumOptions
{
    /**
     * @throws InvalidEnumException|InvalidEnumMethodException|ReflectionException
     */
    public function __invoke(Field $field): array
    {
        [$enum, $method] = array_pad(
            explode('::', $field->enum),
            2,
            null
        );

        if (! enum_exists($enum)) {
            throw new InvalidEnumException(
                "The given enum {$enum} does not exist or is not a valid enum."
            );
        }

        return $this->getOptionsFrom(new ReflectionEnum($enum), $method);
    }

    /**
     * @throws InvalidEnumMethodException|ReflectionException
     */
    protected function getOptionsFrom(ReflectionEnum $enum, ?string $method): array
    {
        $method = Str::replace($method ?? 'cases', '()', '');

        if (! $this->isValidMethod($enum, $method)) {
            throw new InvalidEnumMethodException(
                "The given method {$method} of {$enum->name} does not exist or is not a valid."
            );
        }

        return $this->getOptions($enum, $method);
    }

    /**
     * @throws ReflectionException
     */
    protected function getOptions(ReflectionEnum $enum, ?string $method): array
    {
        return (new Collection(
            $enum->getMethod($method)->invoke(null)
        ))->map(fn ($case) => [
            'value' => (string) ($case->value ?? $case->name),
            'text' => $this->hasLabel($enum) ? $case->toLabel() : $case->name,
        ])->toArray();
    }

    protected function isValidMethod(ReflectionEnum $enum, string $method): bool
    {
        try {
            return $enum->hasMethod($method)
                && ($enum->getMethod($method)->isStatic() && $enum->getMethod($method)->isPublic());
        } catch (ReflectionException $e) {
            return false;
        }
    }

    protected function hasLabel(ReflectionEnum $enum): bool
    {
        return $enum->implementsInterface(HasLabel::class);
    }
}
