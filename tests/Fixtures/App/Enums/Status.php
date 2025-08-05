<?php

namespace Tests\Fixtures\App\Enums;

enum Status: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    public static function published(): array
    {
        return [
            self::Published,
            self::Archived,
        ];
    }
}
