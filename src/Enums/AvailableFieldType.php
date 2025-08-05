<?php

namespace Beebmx\KirbyEnum\Enums;

enum AvailableFieldType: string
{
    case Checkboxes = 'checkboxes';
    case Multiselect = 'multiselect';
    case Radio = 'radio';
    case Select = 'select';
    case Tags = 'tags';
    case Toggles = 'toggles';

    public function toComponent(): string
    {
        return match ($this->value) {
            'checkboxes' => 'k-checkboxes-field',
            'multiselect' => 'k-multiselect-field',
            'radio' => 'k-radio-field',
            'select' => 'k-select-field',
            'tags' => 'k-tags-field',
            'toggles' => 'k-toggles-field',
        };
    }

    public function toValue(): string
    {
        return match ($this->value) {
            'checkboxes',
            'multiselect',
            'tags' => 'array',
            default => 'string',
        };
    }

    public static function guess($type): string
    {
        return match ($type) {
            'checkboxes' => self::Checkboxes->value,
            'multiselect' => self::Multiselect->value,
            'radio' => self::Radio->value,
            'tags' => self::Tags->value,
            'toggles' => self::Toggles->value,
            default => self::Select->value,
        };
    }
}
