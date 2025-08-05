<?php

namespace Beebmx\KirbyEnum\Actions;

use Beebmx\KirbyEnum\Enums\AvailableFieldType;
use Kirby\Form\Field;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

class MakeEnumField
{
    public function __invoke(): array
    {
        return [
            'mixins' => ['options'],
            'props' => $this->getProps(),
            'computed' => $this->getComputedProps(),
            'methods' => $this->getMethods(),
            'save' => function ($value): string {
                if (is_array($value)) {
                    return A::join($value, ', ');
                }

                return $value ?? '';
            },
        ];
    }

    protected function getProps(): array
    {
        return [
            'as' => fn (?string $type = 'select'): string => $type,
            'enum' => fn (?string $enum = null) => $enum,
        ];
    }

    protected function getComputedProps(): array
    {
        return [
            'guessFieldType' => fn (): string => AvailableFieldType::guess(Str::lower($this->as)),
            'fieldType' => fn (): AvailableFieldType => AvailableFieldType::from($this->guessFieldType ?? 'select'),
            'field' => fn (): string => $this->fieldType->toComponent(),
            'value' => fn (): array|string|null => $this->toValues($this->value),
            'options' => fn () =>
            /**
             * @var Field $this
             *
             * @return array
             */
            (new GetEnumOptions)($this),

        ];
    }

    protected function getMethods(): array
    {
        return [
            'toValues' => fn ($value) => match ($this->fieldType?->toValue()) {
                'array' => (new ValueToArray)($value),
                default => $this->sanitizeOption($value) ?? '',
            },
        ];
    }
}
